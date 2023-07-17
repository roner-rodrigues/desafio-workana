import React, { useState, useEffect } from 'react';
import axios from 'axios';
import ProductSelectForm from '../components/ProductSelectForm';
import Cart from '../components/Cart';

const SalePage = () => {
    const [products, setProducts] = useState([]);
    const [cart, setCart]         = useState({});

    useEffect(() => {
        const fetchProducts = async () => {
            try {
                const response = await axios.get('http://localhost:8080/get_products.php');
                setProducts(response.data);
            } catch (error) {
                if (error.response) {
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.error('There was an error!', error.response.data.error);
                    alert(error.response.data.error);
                } else if (error.request) {
                    // The request was made but no response was received
                    console.error('No response received', error.request);
                } else {
                    // Something happened in setting up the request that triggered an error
                    console.error('Error', error.message);
                }
            }
        }

        fetchProducts();
    }, []);

    const addToCart = (productId, quantity) => {
        setCart(prevCart => ({
            ...prevCart,
            [productId]: (prevCart[productId] || 0) + Number(quantity),
        }));
    };

    const removeFromCart = (productId) => {
        setCart(prevCart => {
            const updatedCart = { ...prevCart };
            delete updatedCart[productId];
            return updatedCart;
        });
    };

    const handleSubmit = async () => {
        const orderItems = Object.entries(cart).map(([productId, quantity]) => {
            const product = products.find(product => product.id === Number(productId));
            const itemPrice = product.price;
            const itemTax = (product.productType.tax_rate / 100) * itemPrice;
    
            return {
                productId,
                quantity,
                itemPrice,
                itemTax,
            };
        });

        if (orderItems.length <= 0) {
         alert('The cart is empty. Please add an item to your cart before proceeding with your purchase.');
         
         return false;
        }

        const totalTax = orderItems.reduce((total, item) => total + item.itemTax * item.quantity, 0);
        const total = orderItems.reduce((total, item) => total + item.itemPrice * item.quantity, 0);
        const order = {
            customerId: 1, 
            totalTax: totalTax,
            total: total + totalTax,
            items: orderItems,
        };
    
        try {
            await axios.post('http://localhost:8080/create_order.php', order);
            alert('Order placed successfully!');
            setCart({});
        } catch (error) {
            if (error.response) {
                console.error('There was an error!', error.response.data.error);
                alert(error.response.data.error);
            } else if (error.request) {
                console.error('No response received', error.request);
            } else {
                console.error('Error', error.message);
            }
        }
    };

    return (
        <div>
            <ProductSelectForm products={products} onAddToCart={addToCart} />
            <Cart cart={cart} products={products} onRemoveFromCart={removeFromCart} />
            <button onClick={handleSubmit}>Submit Order</button>
        </div>
    );
}
export default SalePage;