@php
   $clase="";
   if (isset($esSubmenu)) $clase="children";
   else $clase="flex flex-sb";
@endphp
<ul class="{{$clase}}">
@php

    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }

@endphp

@foreach ($items->sortBy('order') as $item)

    <?php
    
        $originalItem = $item;
        if (Voyager::translatable($item)) {
            $item = $item->translate($options->locale);
        }

        $isActive = null;
        $styles = null;
        $icon = null;

        // Background Color or Color
        if (isset($options->color) && $options->color == true) {
            $styles = 'color:'.$item->color;
        }
        if (isset($options->background) && $options->background == true) {
            $styles = 'background-color:'.$item->color;
        }

        // Check if link is current
        if(url($item->link()) == url()->current()){
            $isActive = 'active';
        }

        // Set Icon
        if(isset($options->icon) && $options->icon == true){
            $icon = '<i class="' . $item->icon_class . '"></i>';
        }

    ?>
    <li class="{{ $isActive }} @php if(!$originalItem->children->isEmpty()) echo "submenu"; @endphp"><a href="{{ url($item->link()) }}" target="{{ $item->target }}" style="{{ $styles }}">{!! $icon !!}<span>{{ $item->title }}</span></a>
        @if(!$originalItem->children->isEmpty())
            @include('voyager::menu.default', ['items' => $originalItem->children, 'options' => $options,'esSubmenu'=>'1'])
        @endif
    </li>
@endforeach
</ul>
