import React, { useState } from 'react';
import axios from 'axios';

const ProductTypeCreateForm = () => {
    const [description, setDescription] = useState('');
    const [taxRate, setTaxRate] = useState('');

    const handleSubmit = async (event) => {
        event.preventDefault();
        const productType = {
            description: description,
            taxRate: taxRate,
        };

        try {
            await axios.post('http://localhost:8080/create_product_type.php', productType);
            alert('Product type successfully added!');
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
        <form onSubmit={handleSubmit}>
            <label>
                Description:
                <input type="text" value={description} onChange={e => setDescription(e.target.value)} required />
            </label>
            <label>
                Tax Rate:
                <input type="number" step="0.01" value={taxRate} onChange={e => setTaxRate(e.target.value)} required />
            </label>
            <input type="submit" value="Submit" />
        </form>
    );
}

export default ProductTypeCreateForm;
