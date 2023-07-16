import React, { useState, useEffect } from 'react';

const ProductSelectForm = ({ products, onAddToCart }) => {
    const [selectedProduct, setSelectedProduct] = useState('');
    const [quantity, setQuantity]               = useState(1);

    useEffect(() => {
    if (products.length > 0) {
        setSelectedProduct(products[0].id);
    }
    }, [products]);

    const handleSubmit = event => {
        event.preventDefault();
        onAddToCart(selectedProduct, quantity);
        // setSelectedProduct('');
        setQuantity(1);
    };

    return (
        <form onSubmit={handleSubmit}>
            <label>
                Product:
                <select value={selectedProduct} onChange={e => setSelectedProduct(e.target.value)} required>
                    {products.map(product => (
                        <option value={product.id} key={product.id}>{product.name}</option>
                    ))}
                </select>
            </label>
            <label>
                Quantity:
                <input type="number" min="1" value={quantity} onChange={e => setQuantity(e.target.value)} required />
            </label>
            <button type="submit">Add to cart</button>
        </form>
    );
}

export default ProductSelectForm;
