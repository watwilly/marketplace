@if(!isset($innerLoop))
<ul class="nav d-none d-lg-flex">
@else
<ul class="nav flex-column">
@endif

@php

    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }

@endphp

@foreach ($items as $item)

    <?php

        $originalItem = $item;
        if (Voyager::translatable($item)) {
            $item = $item->translate($options->locale);
        }

        $listItemClass = null;
        $linkAttributes =  null;
        $styles = null;
        $icon = null;
        $caret = null;

        // Background Color or Color
        if (isset($options->color) && $options->color == true) {
            $styles = 'color:'.$item->color;
        }
        if (isset($options->background) && $options->background == true) {
            $styles = 'background-color:'.$item->color;
        }

        // With Children Attributes
        if(!$originalItem->children->isEmpty()) {
            $linkAttributes =  'class="nav-link link-secondary active" ';
            $caret = '<span class="caret"></span>';

            if(url($item->link()) == url()->current()){
                $listItemClass = 'dropdown active';
            }else{
                $listItemClass = 'dropdown dropdown__wrapper';
            }
        }

        // Set Icon
        if(isset($options->icon) && $options->icon == true){
            $icon = '<i class="' . $item->icon_class . '"></i>';
        }

     ?>

    <li class="nav-item {{ $listItemClass }}  " >
        <a href="{{ url($item->link()) }}" class="nav-link link-secondary @if(!$originalItem->children->isEmpty()) active @endif" target="{{ $item->target }}" >
            {{ $item->title }}
        </a>
        @if(!$originalItem->children->isEmpty())
                    <div class="dropdown__content dropdown__content--full">
            @include('voyager::menu.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
            </div>
        @endif
    </li>
@endforeach
@if(isset($innerLoop))
@endif
</ul>
