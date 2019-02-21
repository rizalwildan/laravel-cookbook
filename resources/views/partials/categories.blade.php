<div class="nav-scroller bg-white box-shadow">
    <div class="container-fluid">
    <nav class="nav nav-underline">
        <p href="#" class="nav-link">Categories</p>
        <?php
            $categories = getCategories();
        ?>
        @foreach($categories as $category)
            <a href="{{ route('category-by', ['slug' => $category->slug]) }}" class="nav-link">{{ $category->category_name }}</a>
        @endforeach
    </nav>
    </div>
</div>