import React, { useState, useEffect } from 'react';
import axios from 'axios';

export default function PreOrder() {
    const [items, setItems] = useState([]);

    useEffect(() => {
        axios.get(`http://glacial-beach-87404.herokuapp.com/api/pre-order`)
        .then(res => { setItems(res.data) })
    }, [])

    return (
        <main class="max-h-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl mx-auto py-4 sm:py-8 lg:py-16 lg:max-w-none">
                    <h2 class="text-2xl font-extrabold text-gray-900 text-center align-top ">
                        Pre Order
                    </h2>
                    <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-6">
                    {
                        items.length > 0 ?
                        items.map((item) => (
                            <div class="group relative mb-10">
                                <div class="relative w-full bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                                    <img
                                        src={item.image}
                                        alt="..."
                                        class="w-full h-full object-center object-cover"
                                    ></img>
                                </div>
                                <h3 class="mt-5 text-center text-lg font-semibold text-gray-900">
                                    {item.name}
                                </h3>
                                <span class="absolute inset-0 p-2">
                                    {`${item.views} people are viewing`}
                                </span>
                                <h3 class="text-center text-base text-gray-500">
                                    <a href={`/carousel?category=${item.name}`}>
                                        <span class="absolute inset-0"></span>
                                        {`${item.items_left} items in stock`}
                                    </a>
                                </h3>
                            </div>
                        ))
                        :
                        <div>There are no items in the pre order</div>
                    }
                    </div>
                </div>
            </div>
        </main>
    );
}