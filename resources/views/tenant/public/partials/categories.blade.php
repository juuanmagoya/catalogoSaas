<div class="px-4 md:px-6 mt-6 overflow-x-auto">

<div class="flex gap-3 w-max">

<button onclick="filterCategory('all')"
class="category-btn bg-[#1e1e1e] hover:bg-[#b8860b] active:bg-[#b8860b] text-white hover:text-black active:text-black px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300 border border-[#b8860b]/40 hover:border-[#b8860b] active:border-[#b8860b] shadow-md hover:shadow-lg active:shadow-lg"
data-category="all">

Todos

</button>

@foreach($categories as $category)

<button
onclick="filterCategory('{{ $category->id }}')"
class="category-btn bg-[#1e1e1e] hover:bg-[#b8860b] active:bg-[#b8860b] text-white hover:text-black active:text-black px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300 border border-[#b8860b]/40 hover:border-[#b8860b] active:border-[#b8860b] shadow-md hover:shadow-lg active:shadow-lg"
data-category="{{ $category->id }}">

{{ $category->name }}

</button>

@endforeach

</div>

</div>