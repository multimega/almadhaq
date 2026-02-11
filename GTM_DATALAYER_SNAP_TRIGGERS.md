# GTM dataLayer for Snap Pixel Triggers

This document describes the dataLayer event architecture used so GTM triggers (e.g. Snap Pixel Sign up, Add to cart, Purchase) fire correctly.

## Trigger filter (GTM)

Your GTM triggers use **Custom Event** with these exact filters:

- **Sign up:** `_event` equals `Sign up`
- **Add to cart:** `_event` equals `Add to cart`
- **Purchase:** `_event` equals `purchase`

Casing and spaces must match exactly.

---

## pushDL helper

```javascript
function pushDL(eventName, data) {
  window.dataLayer = window.dataLayer || [];
  var payload = { _event: eventName };
  if (data && typeof data === 'object') {
    for (var k in data) {
      if (data.hasOwnProperty(k) && data[k] !== undefined && data[k] !== '') payload[k] = data[k];
    }
  }
  window.dataLayer.push(payload);
  if (window.console && window.console.log) {
    try { window.console.log('[DL PUSH]', payload); } catch (e) {}
  }
}
```

- **Where defined:** `resources/views/layouts/front.blade.php` (after GTM snippet), and `resources/views/layouts/footer_demo10.blade.php` (only if not already defined).
- **Usage:** `pushDL('Sign up', { user_email: '...', user_phone: '...' });`

---

## Event payloads

### 1. Sign up

**When:** After registration succeeds (next page load; not when the user only opens the signup page).

**Payload:**

| Key           | Type   | Source |
|---------------|--------|--------|
| `_event`      | string | `"Sign up"` |
| `event_source`| string | `"signup_form"` |
| `user_email`  | string \| null | From registration form (session) |
| `user_phone`  | string \| null | From registration form (session) |

**Example:**

```javascript
{ _event: "Sign up", event_source: "signup_form", user_email: "user@example.com", user_phone: "+966..." }
```

---

### 2. Add to cart

**When:** Only after the add-to-cart request succeeds (AJAX success). Not on click alone.

**Payload:**

| Key            | Type    | Source |
|----------------|---------|--------|
| `_event`       | string  | `"Add to cart"` |
| `user_email`   | string \| null | Not set (null) unless you add later |
| `user_phone`   | string \| null | Not set (null) |
| `number_items` | integer | 1 (single add) |
| `price`        | number  | Item price from DOM |
| `currency`     | string  | e.g. `"SAR"` from `$curr->name` |
| `item_ids`     | array   | `[productId]` from link `data-href` / addcart URL |
| `item_category`| string \| null | From product block in DOM |

**Example:**

```javascript
{ _event: "Add to cart", number_items: 1, price: 99.5, currency: "SAR", item_ids: ["123"], item_category: "Electronics", user_email: null, user_phone: null }
```

---

### 3. Purchase

**When:** On order confirmation (thank-you / success page). Fired once per `transaction_id` (guarded with `sessionStorage`).

**Payload:**

| Key              | Type    | Source |
|------------------|---------|--------|
| `_event`         | string  | `"purchase"` |
| `transaction_id`| string  | `$order->order_number` |
| `user_email`     | string \| null | `$order->user->email` if available |
| `user_phone`     | string \| null | `$order->customer_phone` |
| `number_items`   | integer | Count of cart items |
| `price`          | number  | `$order->pay_amount` (order total) |
| `currency`       | string  | `$order->currency_sign` (e.g. SAR) |
| `item_ids`       | array   | SKU/id per item from order cart |
| `item_category`  | null    | Optional, currently null |

**Example:**

```javascript
{ _event: "purchase", transaction_id: "ORD-123", user_email: null, user_phone: "+966...", number_items: 2, price: 249.99, currency: "SAR", item_ids: ["SKU1","SKU2"], item_category: null }
```

---

## Data types

- **price:** number (not string; no "SAR" in value).
- **number_items:** integer.
- **item_ids:** array of strings (SKU or id).
- Missing/optional values: `null` or omitted, not placeholder text.
- **pixel_id** is set in the GTM tag (Snap Pixel), not in the dataLayer.

---

## Where data is taken from

| Event      | Source |
|-----------|--------|
| Sign up   | Session after `RegisterController@register`: `gtm_sign_up_data` (user_email, user_phone from request). |
| Add to cart | DOM: product block (`.product`, etc.) for name, price, category; `data-href` or URL for product id. Fired in `ajaxSuccess` when URL contains `addcart` and response is JSON array. |
| Purchase  | `$order` on success view: `order_number`, `pay_amount`, `customer_phone`, `user` (email), decoded `cart` for items and item_ids. |

---

## Duplicate prevention

- **Purchase:** `sessionStorage` key `dl_purchase_{transaction_id}`. If key exists, push is skipped.
- **Add to cart:** Fired only once per successful add (in `ajaxSuccess`); pending data is cleared after push.
- **Sign up:** Fired once per registration (session flags pulled after use).

---

## Files changed

| File | Change |
|------|--------|
| `resources/views/layouts/front.blade.php` | Added pushDL script after GTM. Sign up block now pushes `_event: "Sign up"` with user_email, user_phone, event_source from session. |
| `resources/views/layouts/footer_demo10.blade.php` | Added pushDL (if undefined). Add to cart: store pending product on click; on `ajaxSuccess` for addcart URL push `_event: "Add to cart"` with correct types. |
| `resources/views/front/success.blade.php` | Replaced old ecommerce push with single push: `_event: "purchase"`, transaction_id, user_email, user_phone, number_items, price, currency, item_ids; sessionStorage guard. |
| `app/Http/Controllers/User/RegisterController.php` | On successful register, set `gtm_sign_up_data` in session (user_email, user_phone from request). |

---

## Test plan

### GTM Preview

1. Open GTM → Preview → enter site URL.
2. In the Tag Assistant:
   - **Data Layer** tab: after each action, confirm a new push with the expected `_event` and fields.
   - **Tags** tab: confirm “Snap Pixel Sign up”, “Snap Pixel Add to cart”, “Snap Pixel Purchase” fire when the corresponding event appears.

### Per event

1. **Sign up**
   - Submit registration form (valid data).
   - On the next page load, check Data Layer for `_event: "Sign up"` and non-empty user_email/user_phone if provided.
   - Confirm Snap Pixel Sign up tag fires once.

2. **Add to cart**
   - Click “Add to cart” on a product (theme that uses footer_demo10 + addcart AJAX).
   - After success (e.g. toast/cart update), check Data Layer for `_event: "Add to cart"` with number_items, price (number), currency, item_ids (array).
   - Confirm Snap Pixel Add to cart tag fires once per add.

3. **Purchase**
   - Complete a test order and land on the success page.
   - Check Data Layer for `_event: "purchase"` with transaction_id, price (number), number_items (integer), item_ids (array).
   - Refresh success page: same event should not fire again (sessionStorage guard).
   - Confirm Snap Pixel Purchase tag fires once.

### Variables

- In GTM, map Data Layer Variables to the keys above (e.g. `DLV - transaction_id`, `DLV - price`).
- In Preview, verify these variables show real values, not placeholders.

---

## Debug

- In the browser console you should see `[DL PUSH]` and the payload for each push when the helper runs.
- For GTM Preview, use the Data Layer tab to inspect the last push and the Variables tab to confirm variable values.
