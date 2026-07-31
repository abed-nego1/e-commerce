<section class="featured-products">
    <div class="section-header">
        <span class="section-tag">Sélection du moment</span>
        <h2>Nos produits phares</h2>
        <p>Une gamme de cosmétiques choisis pour leur qualité, leur douceur et leur efficacité.</p>
    </div>

    <div class="products-grid">
        @foreach ($products as $product)
            <div class="product-card">
                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                <div class="product-info">
                    <h3>{{ $product['name'] }}</h3>
                    <p>{{ $product['description'] }}</p>
                    <span class="price">{{ number_format($product['price'], 2, ',', ' ') }} €</span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="products-action">
        <a href="{{ url('/products') }}" class="btn-primary">Explorer la boutique</a>
    </div>
</section>
