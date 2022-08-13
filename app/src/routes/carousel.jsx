import React, { useState, useEffect } from "react";
import axios from "axios";
import { useSearchParams, useNavigate  } from "react-router-dom";
import "tw-elements";

export default function Carousel() {
  const [items, setItems] = useState([]);
  const [searchParams, setSearchParams] = useSearchParams();
  const navigate = useNavigate();

  useEffect(() => {
      axios.get(`http://127.0.0.1:8000/api/carousel/${searchParams.get("category")}`)
      .then(res => { setItems(res.data[0][0]) })
     
  }, [])

  const handleInput = (name, category, price, tier, status="complete") => {
    const payload = {
      name, category, price, tier, status
    }
    axios.post('http://127.0.0.1:8000/api/carousel/cart', payload)
    .then(res => { 
      // navigate("/faqs")
    })
    .catch(error => {
      console.log("/api/carousel/cart didn't work")
    })
  }

  return (
    <main>
      <div>
        <div>
          <div class="mt-6 max-w-2xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
            
            {/* First Card  */}
            <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
            <a href={items.image_path} target="_blank">
              <img
                src={items.image_path}
                alt="First card"
                class="w-full h-full object-center object-cover"
              ></img>
              </a>
            </div>

            {/* Second Card  */}
            <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
            <a href={items.image_path} target="_blank">
              <img
                src={items.image_path}
                alt="First card"
                class="w-full h-full object-center object-cover"
              ></img>
              </a>
            </div>

            {/* Third Card  */}
            <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
              <a href={items.image_path} target="_blank">
              <img
                src={items.image_path}
                alt="First card"
                class="w-full h-full object-center object-cover"
              ></img>
              </a>
            </div>
          </div>

          <div class="max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:pb-24 lg:px-8 lg:grid lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8">
            <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
              <h1 class="text-2xl font-bold tracking-tight text-blue-900 sm:tracking-tight sm:text-3xl">
                {items.item}
              </h1>

              <h4 class="text-sm font-regular tracking-tight text-blue-900 sm:tracking-tight sm:text-sm">
                Brand: {items.brand}
              </h4>
              <h4 class="text-sm font-regular tracking-tight text-blue-900 sm:tracking-tight sm:text-sm">
                Color: {items.color}
              </h4>
            </div>

            <div class="mt-4 lg:mt-0 lg:row-span-3">
              <h2 class="sr-only">Product information</h2>
              <p class="tracking-tight text-3xl text-gray-900">£{items.price}</p>

              <div class="mt-6">
                <h3 class="sr-only">Reviews</h3>
                <div class="flex items-center">
                  <div class="flex items-center">
                    <svg
                      class="text-gray-900 h-5 w-5 flex-shrink-0"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true"
                    >
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>

                    <svg
                      class="text-gray-900 h-5 w-5 flex-shrink-0"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true"
                    >
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>

                    <svg
                      class="text-gray-900 h-5 w-5 flex-shrink-0"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true"
                    >
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>

                    <svg
                      class="text-gray-200 h-5 w-5 flex-shrink-0"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true"
                    >
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>

                    <svg
                      class="text-gray-200 h-5 w-5 flex-shrink-0"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true"
                    >
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                  </div>
                  <p class="sr-only">3 out of 5 stars</p>
                  <a
                    href="#"
                    class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500"
                  >
                    4 Viewing
                  </a>
                </div>
              </div>
                <div class="mt-10">
                  <div class="flex items-center justify-between">
                    <h3 class="text-sm text-gray-900 font-medium">
                      Choose Option
                    </h3>
                  </div>

                  <fieldset class="mt-4">
                    <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                      <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-green-500 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                        <button
                          onClick={() => handleInput(items.item, items.category, items.price, items.tier)}
                        >
                          YES
                        </button>
                      </label>

                      <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-blue-300 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                      <button>MAYBE</button>
                      </label>

                      <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-red-500 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                      <button>NO</button>
                      </label>
                    </div>
                  </fieldset>
                </div>

                <button
                  class="mt-10 w-full bg-yellow-500 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                  View Cart
                </button>
            </div>

            <div class="py-10 lg:pt-6 lg:pb-16 lg:col-start-1 lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
              {/* Tier 1 Button */}
              <div class="mt-10">
                <div class="mt-4 space-y-6">
                  <button
                    type="button"
                    class="inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-full"
                  >
                    Tier 1
                  </button>
                </div>
              </div>

              {/* Tier 2 Button */}
              <div class="mt-10">
                <div class="mt-4 space-y-6">
                  <button
                    type="button"
                    class="inline-block px-6 py-2 border-2 border-gray-200 text-black-50 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-full"
                  >
                    Show Tier 2
                  </button>
                </div>
              </div>

              {/* Tier 3 Button */}
              <div class="mt-10">
                <div class="mt-4 space-y-6">
                  <button
                    type="button"
                    class="inline-block px-6 py-2 border-2 border-gray-200 text-black-50 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-full"
                  >
                    Show Tier 3
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  );
}
