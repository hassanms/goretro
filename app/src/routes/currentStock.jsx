import React, { useState, useEffect } from 'react';
import axios from 'axios';

export default function CurrentStock() {
    const [stocks, setStocks] = useState([]);

    useEffect(() => {
        axios.get(`http://127.0.0.1:8000/api/currentStock`)
        .then(res => { setStocks(res.data[0]) })
    }, [])
    
    return (
        <main style={{}}>
            <div class="bg-orange-50 max-h-full">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-2xl mx-auto py-16 sm:py-24 lg:py-32 lg:max-w-none">
                        <h2 class="text-2xl font-extrabold text-gray-900 text-center align-top ">
                            Current Stock
                        </h2>
                        {
                            stocks.map((stock, index) => (
                                <div key={index} class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-6">
                                    <div class="group relative">
                                        <div class="relative w-full bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                                            <img
                                                src="https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/c013660a-93fe-48eb-bd2f-ca731d344905/fitness-hoodie-QbMW7g.png"
                                                alt="Sweatshirts in this category"
                                                class="w-full h-full object-center object-cover"
                                            ></img>
                                        </div>
                                        <h3 class="mb-10 text-center text-base font-semibold text-gray-900">
                                            {stock.name}
                                        </h3>
                                        <h3 class="mt-3 text-sm text-gray-500">
                                            <span class="absolute inset-0">{`${stock.views} people are viewing`}</span>
                                        </h3>
                                        <h3 class="mb-10 text-center text-base font-semibold text-gray-900">
                                            <a href={`/carousel?category=${stock.category}`}>
                                                <span class="absolute inset-0"></span>
                                                {`${stock.items_left} items in stock`}
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            ))
                        }
                    </div>
                </div>
            </div>
        </main>
    );
}
