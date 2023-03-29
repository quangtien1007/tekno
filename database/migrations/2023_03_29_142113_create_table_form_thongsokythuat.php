<?php

use App\Models\FormMau;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_mau', function (Blueprint $table) {
            $table->id();
            $table->text('form')->nullable();
            $table->timestamps();
        });


        //1. motasanpham - baiviet
        FormMau::create(['form' => '
        <table style="border-collapse: collapse; width: 85.0822%; height: 38px; border-width: 0px; margin-left: auto; margin-right: auto;" border="1"><colgroup><col style="width: 100%;"></colgroup>
            <tbody>
            <tr>
            <td style="border-width: 0px;">

            </td>
            </tr>
            </tbody>
            </table>']);


        //2. tskt_dienthoai, tskt_tablet
        FormMau::create(['form' => '<table style="border-collapse: collapse; width: 71.1009%; height: 1360.8px; border-width: 1px; margin-left: auto; margin-right: auto;" border="1"><colgroup><col style="width: 48.5276%;"><col style="width: 51.4534%;"></colgroup>
        <tbody>
        <tr style="height: 29.7875px; background-color: rgb(126, 140, 141);">
        <td style="height: 29.7875px; border-width: 1px;" colspan="2"><strong>M&agrave;n h&igrave;nh</strong></td>
        </tr>
        <tr style="height: 29.7875px;">
        <td style="height: 29.7875px; border-width: 1px;">C&ocirc;ng nghệ m&agrave;n h&igrave;nh</td>
        <td style="height: 29.7875px; border-width: 1px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 30.9875px;">
        <td style="height: 30.9875px; border-width: 1px;">Độ ph&acirc;n giải</td>
        <td style="height: 30.9875px; border-width: 1px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 29.7875px;">
        <td style="height: 29.7875px; border-width: 1px;">M&agrave;n hinh rộng</td>
        <td style="height: 29.7875px; border-width: 1px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 29.7875px;">
        <td style="height: 29.7875px; border-width: 1px;">Độ s&aacute;ng tối đa</td>
        <td style="height: 29.7875px; border-width: 1px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 29.7875px;">
        <td style="height: 29.7875px; border-width: 1px;">Mặt k&iacute;nh cảm ứng</td>
        <td style="height: 29.7875px; border-width: 1px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 29.8px; background-color: rgb(126, 140, 141);">
        <td style="height: 29.8px; border-width: 1px;" colspan="2"><strong>Camera trước</strong></td>
        </tr>
        <tr style="height: 22.725px;">
        <td style="border-width: 1px; height: 22.725px;">Độ ph&acirc;n giải</td>
        <td style="border-width: 1px; height: 22.725px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 326.263px; text-align: left;">
        <td style="border-width: 1px; height: 326.263px; text-align: left;">Quay phim</td>
        <td style="border-width: 1px; height: 326.263px;">
        <p class="circle" style="padding-left: 40px;">&nbsp;</p>
        </td>
        </tr>
        <tr style="height: 597.5px;">
        <td style="border-width: 1px; height: 597.5px;">T&iacute;nh năng:</td>
        <td style="border-width: 1px; height: 597.5px;">&nbsp;</td>
        </tr>
        <tr style="height: 22.725px; background-color: rgb(126, 140, 141);">
        <td style="border-width: 1px; height: 22.725px;" colspan="2">&nbsp;</td>
        </tr>
        <tr style="height: 22.725px;">
        <td style="border-width: 1px; height: 22.725px;">Hệ điều h&agrave;nh</td>
        <td style="border-width: 1px; height: 22.725px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 22.725px;">
        <td style="border-width: 1px; height: 22.725px;">Chip xử l&yacute;</td>
        <td style="border-width: 1px; height: 22.725px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 22.725px;">
        <td style="border-width: 1px; height: 22.725px;">Chip đồ họa</td>
        <td style="border-width: 1px; height: 22.725px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 22.725px;">
        <td style="border-width: 1px; height: 22.725px;">Tốc độ GPU</td>
        <td style="border-width: 1px; height: 22.725px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 22.725px; background-color: rgb(126, 140, 141);">
        <td style="border-width: 1px; height: 22.725px;" colspan="2"><strong>Pin &amp; Sạc</strong></td>
        </tr>
        <tr style="height: 22.725px;">
        <td style="border-width: 1px; height: 22.725px;">Dung lượng pin:</td>
        <td style="border-width: 1px; height: 22.725px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 22.725px;">
        <td style="border-width: 1px; height: 22.725px;">Loại pin:</td>
        <td style="border-width: 1px; height: 22.725px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 22.7875px;">
        <td style="border-width: 1px; height: 22.7875px;">Hỗ trợ sạc tối đa:</td>
        <td style="border-width: 1px; height: 22.7875px; padding-left: 40px;">&nbsp;</td>
        </tr>
        <tr>
        <td style="border-width: 1px;">C&ocirc;ng nghệ pin:</td>
        <td style="border-width: 1px; padding-left: 40px;">
        <p class="circle">&nbsp;</p>
        </td>
        </tr>
        </tbody>
        </table>']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_form_thongsokythuat');
    }
};
