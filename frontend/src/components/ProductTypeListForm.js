import React, { useEffect, useState } from "react";
import axios from 'axios';

function ProductTypeList() {
  const [productTypes, setProductTypes] = useState([]);

  useEffect(() => {
    axios.get("http://localhost:8080/get_product_types.php")
      .then((response) => setProductTypes(response.data))
      .catch((error) => console.error(error));
  }, []);

  return (
    <div>
      <h1>Product Types</h1>
      {productTypes.map((productType) => (
        <div key={productType.id}>
          <h2>Type: {productType.description}</h2>
          <p>Tax Rate: {productType.tax_rate}</p>
        </div>
      ))}
    </div>
  );
}

export default ProductTypeList;
