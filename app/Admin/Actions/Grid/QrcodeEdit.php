<?php

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Admin\Forms\Qrcode;
use Dcat\Admin\Widgets\Modal;
class QrcodeEdit extends RowAction
{
    /**
     * @return string
     */
	protected $title = '<a><i class="feather icon-edit-1">修改</i></a>';

    public function render()
    {
        // 实例化表单类并传递自定义参数
        // $form = Qrcode::make()->payload(['id' => $this->getKey()]);
        $form = Qrcode::make();

        return Modal::make()
            ->lg()
            ->title($this->title)
            ->body($form)
            ->button($this->title);
    }

    
}
