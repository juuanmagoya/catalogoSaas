<script>

// ==================== DATA ====================

const productsData = @json(
    $categories->flatMap->products->keyBy('id')
);

// ==================== VARIABLES ====================

let currentCategory = "all";


// ==================== MODAL INFO ====================

function openInfoModal() {

    const modal = document.getElementById("infoModal");

    if(!modal) return;

    modal.style.display = "flex";

    document.body.style.overflow = "hidden";
}

function closeInfoModal() {

    const modal = document.getElementById("infoModal");

    if(!modal) return;

    modal.style.display = "none";

    document.body.style.overflow = "";
}


// ==================== MODAL PRODUCTO ====================

let selectedProductId = null;

function openProductModal(productId) {

    const product = productsData[productId];

    if(!product) return;

    selectedProductId = productId;

    document.getElementById("modalProductName").textContent = product.name;

    document.getElementById("modalProductDescription").textContent =
        product.description || "Sin descripción disponible";

    document.getElementById("modalProductPrice").textContent =
        "$" + product.price;

    document.getElementById("modalProductImg").src =
        product.image_path
        ? "/storage/" + product.image_path
        : "/storage/default.jpg";

    document.getElementById("productModal").style.display = "flex";

    document.body.style.overflow = "hidden";
}

function closeProductModal() {

    document.getElementById("productModal").style.display = "none";

    document.body.style.overflow = "";
}

// Cerrar al hacer click fuera del modal //
document.getElementById("productModal").addEventListener("click", function(e){

    if(e.target.id === "productModal"){
        closeProductModal();
    }

});


// ==================== FILTRO CATEGORIA ====================

function filterCategory(categoryId) {

    currentCategory = categoryId;

    const buttons = document.querySelectorAll(".category-btn");

    // Remover clase active de todos los botones
    buttons.forEach(btn => {
        btn.classList.remove("active");
    });

    // Agregar clase active al botón clickeado
    const activeBtn = document.querySelector(`.category-btn[data-category="${categoryId}"]`);
    
    if(activeBtn){
        activeBtn.classList.add("active");
    }

    applyFilters();
}



// ==================== FILTROS ====================

function applyFilters(){

    const search = document
        .getElementById("searchInput")
        .value
        .toLowerCase()
        .trim();

    const products = document.querySelectorAll(".product-card");
    const sections = document.querySelectorAll(".category-section");

    // ====================
    // FILTRAR PRODUCTOS
    // ====================

    products.forEach(product => {

        const name = product.dataset.name;
        const category = product.dataset.category;

        const matchCategory =
            currentCategory === "all" || category === currentCategory;

        const matchSearch =
            name.includes(search);

        if(matchCategory && matchSearch){

            product.classList.remove("hidden");

        }else{

            product.classList.add("hidden");

        }

    });


    // ====================
    // OCULTAR CATEGORIAS VACIAS
    // ====================

    sections.forEach(section => {

        const visibleProducts = section.querySelectorAll(
            ".product-card:not(.hidden)"
        );

        if(visibleProducts.length > 0){

            section.classList.remove("hidden");

        }else{

            section.classList.add("hidden");

        }

    });

}


// ==================== ESC ====================

document.addEventListener("keydown", function(e){

    if(e.key === "Escape"){

        closeInfoModal();

        closeProductModal();

        closeCart();

    }

});


// ==================== INIT ====================

document.addEventListener("DOMContentLoaded", function(){

    closeInfoModal();

    closeProductModal();

    loadCart();

    const searchInput = document.getElementById("searchInput");

        if(searchInput){
            searchInput.addEventListener("keyup", applyFilters);
        }

});


// =======================================================
// 🛒 CARRITO
// =======================================================

let cart = JSON.parse(localStorage.getItem("cart")) || [];


// ==================== AGREGAR AL CARRITO ====================

function addToCart(){

    if(!selectedProductId) return;

    const product = productsData[selectedProductId];

    const img = document.getElementById("modalProductImg");

    flyToCart(img);

    const existing = cart.find(item => item.id === product.id);

    if(existing){

        existing.quantity++;

    }else{

        cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            quantity: 1
        });

    }

    saveCart();

    updateCartUI();

    closeProductModal();
}

// Animación de vuelo al carrito //
function flyToCart(img){

    const cartIcon = document.querySelector('[onclick="openCart()"]');

    if(!img || !cartIcon) return;

    const flyingImg = img.cloneNode(true);

    const imgRect = img.getBoundingClientRect();
    const cartRect = cartIcon.getBoundingClientRect();

    flyingImg.style.position = "fixed";
    flyingImg.style.left = imgRect.left + "px";
    flyingImg.style.top = imgRect.top + "px";
    flyingImg.style.width = "120px";
    flyingImg.style.height = "120px";
    flyingImg.style.borderRadius = "12px";
    flyingImg.style.transition = "all .7s cubic-bezier(.65,-0.25,.25,1.25)";
    flyingImg.style.zIndex = "9999";
    flyingImg.style.pointerEvents = "none";

    document.body.appendChild(flyingImg);

    setTimeout(()=>{

        flyingImg.style.left = cartRect.left + "px";
        flyingImg.style.top = cartRect.top + "px";
        flyingImg.style.width = "20px";
        flyingImg.style.height = "20px";
        flyingImg.style.opacity = "0.5";

    },50);

    setTimeout(()=>{
        flyingImg.remove();
    },700);

}


// ==================== GUARDAR ====================

function saveCart(){

    localStorage.setItem("cart", JSON.stringify(cart));

}


// ==================== CARGAR ====================

function loadCart(){

    updateCartUI();


}


// ==================== UI ====================

function updateCartUI(){

    const cartItemsContainer = document.getElementById("cartItems");
    const cartCount = document.getElementById("cartCount");

    cartItemsContainer.innerHTML = "";

    let total = 0;
    let count = 0;

    cart.forEach(item => {

        total += item.price * item.quantity;
        count += item.quantity;

        cartItemsContainer.innerHTML += `
        
        <div class="flex justify-between items-center bg-gray-800 rounded-xl p-3">

            <div>
                <p class="text-white font-medium">${item.name}</p>
                <p class="text-gray-400 text-sm">$${item.price}</p>
            </div>

            <div class="flex items-center gap-3">

                <button 
                    onclick="decreaseQuantity(${item.id})"
                    class="w-8 h-8 bg-gray-700 rounded-lg text-white text-lg">
                    -
                </button>

                <span class="text-white font-semibold">
                    ${item.quantity}
                </span>

                <button 
                    onclick="increaseQuantity(${item.id})"
                    class="w-8 h-8 bg-amber-500 rounded-lg text-black text-lg">
                    +
                </button>

            </div>

        </div>
        `;
    });

    document.getElementById("cartTotal").innerText = "$" + total;

    if(cartCount){
        cartCount.innerText = count;
    }

}

// ==================== DISMINUIR CANTIDAD ====================
function increaseQuantity(productId){

    const item = cart.find(p => p.id === productId);

    if(!item) return;

    if(item.quantity >= 10) return;

    item.quantity++;

    saveCart();

    updateCartUI();
}

// ==================== AUMENTAR CANTIDAD ====================
function decreaseQuantity(productId){

    const item = cart.find(p => p.id === productId);

    if(!item) return;

    if(item.quantity <= 1) return;

    item.quantity--;

    saveCart();

    updateCartUI();
}


// Animación de rebote en el icono del carrito //
function cartIconBounce(){

    const cartIcon = document.querySelector('[onclick="openCart()"]');

    if(!cartIcon) return;

    cartIcon.animate([
        { transform: "scale(1)" },
        { transform: "scale(1.2)" },
        { transform: "scale(1)" }
    ],{
        duration:300
    });

}


// ==================== ELIMINAR ====================

function removeFromCart(index){

    cart.splice(index,1);

    saveCart();

    updateCartUI();

}


// ==================== VACIAR ====================

function clearCart(){

    cart = [];

    saveCart();

    updateCartUI();

}


// ==================== MODAL CARRITO ====================

function openCart(){

    document.getElementById("cartModal").style.display = "flex";

    document.body.style.overflow = "hidden";
}

function closeCart(){

    document.getElementById("cartModal").style.display = "none";

    document.body.style.overflow = "";
}


// ==================== ENVIAR WHATSAPP ====================

function sendOrder(){

    if(cart.length === 0) return;

    let message = "Hola! Quiero pedir:%0A";

    let total = 0;

    cart.forEach(item => {

        message += `• ${item.name} x${item.quantity}%0A`;

        total += item.price * item.quantity;

    });

    message += `%0ATotal: $${total}`;

    const phone = "{{ $tenant->whatsapp_number }}";

    const url = `https://wa.me/${phone}?text=${message}`;

    window.open(url,"_blank");
}

// Funcionalidad para mostrar/ocultar botón de limpiar
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearSearch');
    
    if (searchInput && clearButton) {
        searchInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                clearButton.classList.remove('opacity-0', 'invisible');
                clearButton.classList.add('opacity-100', 'visible');
            } else {
                clearButton.classList.remove('opacity-100', 'visible');
                clearButton.classList.add('opacity-0', 'invisible');
            }
        });
        
        clearButton.addEventListener('click', function() {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            searchInput.focus();
            // Aquí puedes llamar a tu función de búsqueda
            if (typeof applyFilters === 'function') {
                applyFilters();
            }
        });
    }
</script>
