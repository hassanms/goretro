import React, { useState, useEffect } from 'react';
import axios from 'axios';

export default function CurrentStock() {
    const [stocks, setStocks] = useState([]);

    useEffect(() => {
        axios.get(`http://127.0.0.1:8000/api/currentStock`)
        .then(res => { setStocks(res.data) })
    }, [])
    
    return (
        <main class="max-h-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl mx-auto py-4 sm:py-8 lg:py-16 lg:max-w-none">
                    <h2 class="text-2xl font-extrabold text-gray-900 text-center align-top ">
                        Current Stock
                    </h2>
                    <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-6">
                    {
                        stocks.length > 0 ?
                        stocks.map((stock) => (
                            
                                <div class="group relative mb-10">
                                    <div class="relative w-full bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                                        <img
                                            src={stock.image}
                                            alt="..."
                                            class="w-full h-full object-center object-cover"
                                        ></img>
                                    </div>
                                    <h3 class="mt-5 text-center text-base font-semibold text-gray-900">
                                        {stock.name}
                                    </h3>
                                    <span class="font-bold text-indigo-900 absolute inset-0 p-2">
                                        {`${stock.views} people are viewing`}
                                    </span>
                                    <h3 class="text-center text-base text-gray-500">
                                        <a href={`/carousel?category=${stock.name}`}>
                                            <span class="absolute inset-0"></span>
                                            {`${stock.items_left} items in stock`}
                                        </a>
                                    </h3>
                                </div>
                            
                        ))
                        :
                        <div>There are no items in the current stock</div>
                    }
                    </div>
                </div>
            </div>
        </main>
    );
}
