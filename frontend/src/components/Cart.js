import React from 'react';

const Cart = ({ cart, products }) => {
    const calculateSubtotal = (productId, quantity) => {
        const product = products.find(product => product.id === productId);
        return product.price * quantity;
    };

    const calculateTax = (productId, quantity) => {
        const product = products.find(product => product.id === productId);
        return (product.productType.tax_rate / 100) * calculateSubtotal(productId, quantity);
    };

    const calculateTotal = () => {
        let total = 0;
        for (let productId in cart) {
            total += calculateSubtotal(Number(productId), cart[Number(productId)]);
        }
        return total;
    };

    const calculateTotalTax = () => {
        let totalTax = 0;
        for (let productId in cart) {
            totalTax += calculateTax(Number(productId), cart[Number(productId)]);
        }
        return totalTax;
    };

    return (
        <div>
            <h2>Cart</h2>
            {Object.entries(cart).map(([productId, quantity]) => {
                const product = products.find(product => product.id === Number(productId));
                return (
                    <div key={productId}>
                        <h3>{product ? product.name : 'Product not found'}</h3>
                        <p>Quantity: {quantity}</p>
                        <p>Subtotal: {product ? calculateSubtotal(Number(productId), quantity).toFixed(2) : 'N/A'}</p>
                        <p>Tax: {product ? calculateTax(Number(productId), quantity).toFixed(2) : 'N/A'}</p>
                    </div>
                );
            })}
            <h2>Total: {(
                calculateTotal() + calculateTotalTax()
            ).toFixed(2)}</h2>
            <h2>Total Tax: {calculateTotalTax().toFixed(2)}</h2>
        </div>
    );    
}

export default Cart;
