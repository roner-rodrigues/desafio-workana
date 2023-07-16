import React, { useState, useEffect } from 'react';
import axios from 'axios';
import '../styles/ProductForm.css';

const ProductForm = () => {
    const [productName, setProductName]   = useState('');
    const [price, setPrice]               = useState('');
    const [productTypes, setProductTypes] = useState([]);
    const [productType, setProductType]   = useState('');

    useEffect(() => {
        const fetchProductTypes = async () => {
            try {
                const response = await axios.get('http://localhost:8080/get_product_types.php');
                setProductTypes(response.data);
                setProductType(response.data[0]?.id);  
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

        fetchProductTypes();
    }, []);

    const handleSubmit = async (event) => {
        event.preventDefault();
        const product = {
            name:        productName,
            productType: productType,
            price:       price
        };

        try {
            await axios.post('http://localhost:8080/create_product.php', product);
            alert('Product successfully added!');
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

    return (
        <form onSubmit={handleSubmit} className="product-form">
            <label>
                Product Name:
                <input type="text" value={productName} onChange={e => setProductName(e.target.value)} required />
            </label>
            <label>
                Product Type:
                <select value={productType} onChange={e => setProductType(e.target.value)} required>
                    {productTypes.map(type => (
                        <option value={type.id} key={type.id}>{type.description}</option>
                    ))}
                </select>
            </label>
            <label>
                Price:
                <input type="number" step="0.01" value={price} onChange={e => setPrice(e.target.value)} required />
            </label>
            <input type="submit" value="Submit" />
        </form>
    );
}

export default ProductForm;
