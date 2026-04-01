<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddMaxTotalUsesToCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * Legacy: `times` stored remaining uses and was decremented each order.
     * New: `max_total_uses` is the cap; `used` counts completed orders (never decremented).
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->unsignedInteger('max_total_uses')->nullable()->after('used');
        });

        // Approximate original cap: remaining + already used
        $rows = DB::table('coupons')
            ->whereNotNull('times')
            ->where('times', '!=', '')
            ->get(['id', 'times', 'used']);

        foreach ($rows as $row) {
            $cap = (int) $row->times + (int) $row->used;
            DB::table('coupons')->where('id', $row->id)->update([
                'max_total_uses' => $cap > 0 ? $cap : null,
                'times' => null,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('max_total_uses');
        });
    }
}
