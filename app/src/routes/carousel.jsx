import React, { useState, useEffect } from "react";
import axios from "axios";
import { useSearchParams, useNavigate } from "react-router-dom";
import "tw-elements";

export default function Carousel() {
  const [items, setItems] = useState([]);
  const [index, setIndex] = useState(0);
  const [cart, setCart] = useState([]);
  const [tierMessage, setTierMessage] = useState("");
  const [whichTier, setWhichTier] = useState(0);
  const [searchParams, setSearchParams] = useSearchParams();
  const [disableCheckout, setDisableCheckout] = useState(false);
  const navigate = useNavigate();

  useEffect(() => {
    axios.get(`http://127.0.0.1:8000/api/carousel/${searchParams.get("category")}`)
      .then(res => {
        setItems(res.data[0]) 
      })


    // fetch the cart details
    axios
      .get("http://127.0.0.1:8000/api/carousel//checkout")
      .then((res) => {
        //Proceed to checkout
        // navigate("/cart");
        setCart(res.data);
        setDisableCheckout(res.data.disableCheckout);
        if(res.data.disableCheckout === true || res.data.disableCheckout === false) {
          localStorage.setItem("cart", JSON.stringify(res.data));
        }
      })
      .catch((error) => {
        alert(error.data);
      });
  }, [])

  // useEffect(() => {
  //   const cart = JSON.parse(localStorage.getItem("cart"));
  //   const newItems = []
  //   if(cart) {
  //     items.map((item) => {
  //       if(cart.cart.filter(c => c.name === item.item)) {
          
  //       } else {
  //         newItems.push(item)
  //       }
  //     })
  //     setItems(newItems)
  //   }
  // }, [cart])

  const handleInput = (name, category, price, tier, status = "complete") => {
    // refresh whichTier
    setWhichTier(0)
    const payload = {
      name, category, price, tier, status
    }
    axios.post('http://127.0.0.1:8000/api/carousel/cart', payload)
      .then(res => {
        console.log("Added successfully")
        setIndex(prev => prev + 1)
      })
      .catch(error => {
        console.log("/api/carousel/cart didn't work")
      })
  }

  const viewCart = () => {
    localStorage.setItem("cart", {});
    axios.get('http://127.0.0.1:8000/api/carousel//checkout')
      .then(res => {
        //Proceed to checkout
        navigate("/cart")
        setCart(res.data)
        // setDisableCheckout(res.data.disableCheckout)
        if(res.data.disableCheckout === true || res.data.disableCheckout === false) {
          localStorage.setItem("cart", JSON.stringify(res.data))
        }
      })
      .catch(error => {
        alert(error.data)
      })

  }

  const removeItem = (itemId, remove) => {
    // refresh whichTier
    setWhichTier(0)
    if(remove) {
      items.filter(item => item.id !== itemId)
    }
    setIndex(prev => prev + 1)
  }

  const viewTier = (tier) => {

    if(tier == "Tier 1")
    {
      axios.get('http://127.0.0.1:8000/api/carousel//show-tier-1')
      .then(res => {
        setTierMessage(res.data + " items are in Tier 1")
        setWhichTier(1)
        console.log(res.data+" items are in Tier 1")
      })
      .catch(error => {
        console.log("cart is empty")
      })
    }
    else if(tier == "Tier 2")
    {
      axios.get('http://127.0.0.1:8000/api/carousel//show-tier-2')
      .then(res => {
        setTierMessage(res.data + " items are in Tier 2")
        setWhichTier(2)
        console.log(res.data+" items are in Tier 2")
      })
      .catch(error => {
        console.log("cart is empty")
      })
    }
    if(tier == "Tier 3")
    {
      axios.get('http://127.0.0.1:8000/api/carousel//show-tier-3')
      .then(res => {
        setTierMessage(res.data + " items are in Tier 3")
        setWhichTier(3)
        console.log(res.data+" items are in Tier 3")
      })
      .catch(error => {
        console.log("cart is empty")
      })
    }
   

  }


  return (
    <main>
      {
        items[index] ?
        <>
          <div class="mt-6 max-w-2xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
            {/* First Card  */}
            <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
              <a href={items[index].image_path} target="__blank" rel="noreferrer">
                <img
                  src={items[index].image_path}
                  alt="First card"
                  class="w-full h-full object-center object-cover"
                ></img>
              </a>
            </div>
  
            {/* Second Card  */}
            <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
              <a href={items[index].image_path} target="__blank" rel="noreferrer">
                <img
                  src={items[index].image_path}
                  alt="First card"
                  class="w-full h-full object-center object-cover"
                ></img>
              </a>
            </div>
  
            {/* Third Card  */}
            <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
              <a href={items[index].image_path} target="__blank" rel="noreferrer">
                <img
                  src={items[index].image_path}
                  alt="First card"
                  class="w-full h-full object-center object-cover"
                ></img>
              </a>
            </div>
          </div>
  
          <div class="max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:pb-24 lg:px-8 lg:grid lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8">
            <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
              <h1 class="text-2xl font-bold tracking-tight text-blue-900 sm:tracking-tight sm:text-3xl">
                {items[index].item}
              </h1>
  
              <h4 class="text-sm font-regular tracking-tight text-blue-900 sm:tracking-tight sm:text-sm">
                Brand: {items[index].brand}
              </h4>
              <h4 class="text-sm font-regular tracking-tight text-blue-900 sm:tracking-tight sm:text-sm">
                Color: {items[index].color}
              </h4>
            </div>
  
            <div class="mt-4 lg:mt-0 lg:row-span-3">
              <h2 class="sr-only">Product information</h2>
              <p class="tracking-tight text-3xl text-gray-900">£{items[index].price}</p>
  
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
                        onClick={() => handleInput(items[index].item, items[index].category, items[index].price, items[index].tier)}
                      >
                        YES
                      </button>
                    </label>
  
                    <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-blue-300 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                      <button onClick={() => removeItem(items[index].id, false)}>MAYBE</button>
                    </label>
  
                    <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-red-500 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                      <button onClick={() => removeItem(items[index].id, true)}>NO</button>
                    </label>
                  </div>
                </fieldset>
              </div>
  
              <button
                class="mt-10 w-full bg-yellow-500 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                onClick={() => !disableCheckout && viewCart()}
                // disbaled={disableCheckout.toString()}
              >
                View Cart
              </button>
              <span>{cart?.disableCheckout && cart?.message}</span>
            </div>
  
            <div class="py-10 lg:pt-6 lg:pb-16 lg:col-start-1 lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
              {/* Tier 1 Button */}
              <div class="mt-10">
                <div class="mt-4 space-y-6">
                  <button
                    onClick={() => viewTier("Tier 1")}
                    class="inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-full"
                  >
                    Tier 1
                  </button>
                  <span>{ whichTier === 1 && tierMessage }</span>
                </div>
              </div>
  
              {/* Tier 2 Button */}
              <div class="mt-10">
                <div class="mt-4 space-y-6">
                  <button
                    onClick={() => viewTier("Tier 2")}
                    class="inline-block px-6 py-2 border-2 border-gray-200 text-black-50 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-full"
                  >
                    Show Tier 2
                  </button>
                  <span>{ whichTier === 2 && tierMessage }</span>
                </div>
              </div>
  
              {/* Tier 3 Button */}
              <div class="mt-10">
                <div class="mt-4 space-y-6">
                  <button
                    onClick={() => viewTier("Tier 3")}
                    class="inline-block px-6 py-2 border-2 border-gray-200 text-black-50 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-full"
                  >
                    Show Tier 3
                  </button>
                  <span>{ whichTier === 3 && tierMessage }</span>
                </div>
              </div>
            </div>
          </div>
        </> 
        :
        <div className="py-12 bg-white">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="lg:text-center">
              <h2 className="text-lg text-indigo-600 font-semibold cursor-pointer" onClick={() => navigate("/current-stock")}>Go Back</h2>
              <p className="mt-2 text-3xl leading-8 font-bold tracking-tight text-gray-900 sm:text-4xl sm:tracking-tight">
                No Products Found
              </p>
              <p className="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                There are currently no products available for purchase in this category. Please try again later.
              </p>
            </div>
          </div>
        </div>
      }
    </main>
  );
}
