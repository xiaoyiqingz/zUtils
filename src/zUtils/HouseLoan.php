<?php
namespace Zutils;

/*
 *
 *1. 等额本息还款法:
 *   每月月供额=〔贷款本金×月利率×(1＋月利率)＾还款月数〕÷〔(1＋月利率)＾还款月数-1〕
 *   每月应还利息=贷款本金×月利率×〔(1+月利率)^还款月数-(1+月利率)^(还款月序号-1)〕÷〔(1+月利率)^还款月数-1〕
 *   每月应还本金=贷款本金×月利率×(1+月利率)^(还款月序号-1)÷〔(1+月利率)^还款月数-1〕
 *   总利息=还款月数×每月月供额-贷款本金
 *2. 等额本金还款法:
 *   每月月供额=(贷款本金÷还款月数)+(贷款本金-已归还本金累计额)×月利率
 *   每月应还本金=贷款本金÷还款月数
 *   每月应还利息=剩余本金×月利率=(贷款本金-已归还本金累计额)×月利率
 *   每月月供递减额=每月应还本金×月利率=贷款本金÷还款月数×月利率
 *   总利息=〔(总贷款额÷还款月数+总贷款额×月利率)+总贷款额÷还款月数×(1+月利率)〕÷2×还款月数-总贷款额
 *
 */

class HouseLoan
{
    protected $type;         // 类型：1等额本息 2 等额本金
    protected $amount;       // 金额
    protected $duration;     // 期限(月)
    protected $rate;         // 利率(月)
    protected $preferential; // 优惠

    protected $interest;     // 利息
    protected $lists;        // 详情

    public function __construct($type, $amount, $duration, $rate = null)
    {
        $this->type     = $type;
        $this->amount   = $amount;
        $this->duration = $duration * 12;

        if (!is_null($rate)) {
            $this->rate = $rate / 12;
        } else {
            if ($duration <= 1) {
                $this->rate = 0.0435 / 12;
            } else if ($duration <= 5) {
                $this->rate = 0.0475 / 12;
            } else {
                $this->rate = 0.049 / 12;
            }
        }
    }

    public function setPreferential($preferential)
    {
        $this->preferential = $preferential;
    }

    /**
     *  计算月供
     *  每月月供额=〔贷款本金×月利率×(1＋月利率)＾还款月数〕÷〔(1＋月利率)＾还款月数-1〕
     */
    public function returnPerMonth()
    {
        return floor($this->amount * $this->rate * pow((1 + $this->rate), $this->duration)
            / (pow((1 + $this->rate), $this->duration) - 1) * 100) / 100;
    }
}
