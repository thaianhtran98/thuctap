<?php

namespace App\Http\Helper;

use Illuminate\Support\Str;

class Helper
{
//    Phần Server
    public static function menu($menus, $parent = 0, $char = '')
    {
        $html = '';

        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent) {
                $html .= '<tr>';
                if ($menu->parent_id != 0)
                    $html .= '<td><input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px"  value="' . $menu->id . '" ></td>';
                else
                    $html .= '<td><input type="checkbox" name="del_id[]" onclick="showbutton()" style="height: 20px;width: 20px"  value="' . $menu->id . '" ></td>';
                $html .= '<td>' . $menu->id . '</td>
                        <td style="text-align: left; width: auto">' . $char . $menu->name . '</td>
                        <td><div id="parent_active_' . $menu->id . '">' . self::active($menu->active, $menu->id, "/admin/menu/change/$menu->id") . '</div></td>
                        <td>' . $menu->updated_at . '</td>';

                $html .= '      <td>
                                    <a class="btn btn-primary btn-sm" href="/admin/menu/edit/' . $menu->id . '" >
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>';

                $html .= '</tr>';
                unset($menus[$key]);
                $html .= self::menu($menus, $menu->id, $char . '|--');
            }
        }
        return $html;
    }

    public static function active($active = 0, $id = 0, $url = ''): string
    {
        return $active == 0 ? '<span id="menu-no-' . $id . '" class="btn btn-danger btn-xs" onclick="change_active(' . $active . ',\'' . $url . '\') " >No</span>' :
            '<span id="menu-yes-' . $id . '" class="btn btn-success btn-xs" onclick="change_active(' . $active . ', \'' . $url . '\')" >Yes</span>';
    }


//    Phần Client

    public static function menus($menus)
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            $html .= '<li style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 16px;">
                        <a  style=" color: silver;font-family: Arial,sans-serif,Roboto; font-size: 16px;" href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html">' . $menu->name . '
                        </a>';

            $html .= '<ul class="sub-menu" style="background: white;max-width: 1000px ;min-width: 50px;text-align: left">';
            foreach ($menu->menu_category as $cate) {
                $html .= ' <li style="text-align: left; float: left;width: 150px;min-width: 100px;">
                            <a href="/' . $menu->id . '/' . $cate->id . '-' . Str::slug($cate->name, '-') . '.html"> ' . $cate->name . ' </a></li>';
            }
            $html .= '</ul>';
            $html .= '</li>';
        }
        return $html;
    }

    public static function isChild($menus, $id)
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }
        return false;
    }


}
