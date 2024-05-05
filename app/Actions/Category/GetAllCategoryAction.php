<?php

namespace App\Actions\Category;

use App\Models\Category\Category;

class GetAllCategoryAction
{

  public static function run()
  {
        return Category::hasChildren()
            ->with(['children' => fn($q) => $q->orderBy('sorted_order')])
            ->orderBy('name')
            ->get();
  }

}
