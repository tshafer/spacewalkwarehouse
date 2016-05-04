<section class="breadcrumbs">
    <div class="container">
        <ul class="horizontal_list clearfix bc_list f_size_medium">
            <li class="m_right_10 current">
                <a href="/" class="default_t_color">
                    Home<i class="fa fa-angle-right d_inline_middle m_left_10"></i>
                </a>
            </li>
            @if(isset($subcategory) && $subcategory->parent()->count())
                <li class="m_right_10 current">
                    <a href="{{route('category', $subcategory->parent()->first()->slug)}}" class="default_t_color">{{$subcategory->parent()->first()->name}}
                    </a> >
                </li>
                <li class="m_right_10 current">
                    <a href="{{route('subcategory',  [$subcategory->parent()->first()->slug,  $subcategory->slug])}}" class="default_t_color">{{$subcategory->name}}
                    </a>
                </li>
            @else
                <li class="m_right_10 current"><a href="{{route('category', $category->slug)}}" class="default_t_color">{{$category->name}}</a>
                </li>
            @endif
        </ul>
    </div>
</section>