import React, { useState, useEffect } from "react";
import axios from "axios";
import { useSearchParams, useNavigate } from "react-router-dom";
import "tw-elements";

export default function Carousel() {
  const [items, setItems] = useState([]);
  const [index, setIndex] = useState(0);
  const [cart, setCart] = useState([]);
  const [whichTier, setWhichTier] = useState(0);
  const [searchParams, setSearchParams] = useSearchParams();
  const [disableCheckout, setDisableCheckout] = useState(false);
  const [damage, setDamage] = useState("hidden");
  const [alertMessage, setAlertMessage] = useState("hidden");
  const navigate = useNavigate();
  const [input, setInput] = useState({
    email: "",
  });
  const [tier1Visibility, setTier1Visibility] = useState("hidden");
  const [tier2Visibility, setTier2Visibility] = useState("hidden");
  const [tier3Visibility, setTier3Visibility] = useState("hidden");
  const [tierItems, setTierItems] = useState(0);
  //States for refreshing carousel

  useEffect(() => {
    axios
      .get(`http://127.0.0.1:8000/api/carousel/${searchParams.get("category")}`)
      .then((res) => {
        setItems(res.data[0]);
      });
  }, []);

  const handleInput = (name, category, price, tier, status = "complete") => {
    // refresh whichTier
    setWhichTier(0);
    const email = JSON.parse(localStorage.getItem("email"));
    if(email != null)
    {
      const payload = {
        name,
        category,
        price,
        tier,
        status,
        email,
      };
      axios
        .post("http://127.0.0.1:8000/api/carousel//cart", payload)
        .then((res) => {
          if (res.data.disableCheckout === true) {
            setDisableCheckout(res.data.disableCheckout);
            console.log(res.data.message);
            setAlertMessage("visible");
          } else {
            console.log("Added successfully");
            setIndex((prev) => prev + 1);
            setAlertMessage("hidden");
          }
        })
        .catch((error) => {
          console.log("/api/carousel/cart didn't work", error.message);
        });
    }
    else
    {
      alert("please write email and press enter")
    }
  };

  const viewCart = () => {
    axios
      .get("http://127.0.0.1:8000/api/carousel//checkout")
      .then((res) => {
        if (res.data.disableCheckout == false) {
          //Proceed to checkout
          localStorage.setItem("cart", JSON.stringify(res.data.cart));
          //Navigate to Cart
          navigate("/cart");
        } else {
          alert(res.data.message+"\n"+res.data.items);
        }
      })
      .catch((error) => {
        alert(error.message);
      });
  };

  const removeItem = (itemId, remove) => {
    // refresh whichTier
    setWhichTier(0);
    if (remove) {
      items.filter((item) => item.id !== itemId);
    }
    setIndex((prev) => prev + 1);
  };

  const showDamage = (name) => {
    const payload = { name };
    axios
      .post("http://127.0.0.1:8000/api/carousel/damage", payload)
      .then((res) => {
        if (res.data) setDamage("visible");
      })
      .catch((error) => {
        alert(error.data);
      });
  };

  const viewTier = (tier) => {
    if (tier == "Tier 1") {
      axios
        .get("http://127.0.0.1:8000/api/carousel//show-tier-1")
        .then((res) => {
          //refresh carousel for only tier 1 items
          console.log(res.data.items);
          setTier1Visibility("visible");
          setTier2Visibility("hidden");
          setTier3Visibility("hidden");
          setTierItems(res.data.count);
        })
        .catch((error) => {
          console.log("cart is empty");
        });
    } else if (tier == "Tier 2") {
      axios
        .get("http://127.0.0.1:8000/api/carousel//show-tier-2")
        .then((res) => {
          //refresh carousel for only tier 2 items
          setTier2Visibility("visible");
          setTier1Visibility("hidden");
          setTier3Visibility("hidden");
          setTierItems(res.data.count);
        })
        .catch((error) => {
          console.log("cart is empty");
        });
    }
    if (tier == "Tier 3") {
      axios
        .get("http://127.0.0.1:8000/api/carousel//show-tier-3")
        .then((res) => {
          //refresh carousel for only tier 3 items
          setTier3Visibility("visible");
          setTier2Visibility("hidden");
          setTier1Visibility("hidden");
          setTierItems(res.data.count);
        })
        .catch((error) => {
          console.log("cart is empty");
        });
    }
  };

  const inputEmail = (e, email) => {
    e.preventDefault();
    localStorage.setItem("email", JSON.stringify(email));
  };

  return (
    <main>
      {items[index] ? (
        <>
          <div class="bg-indigo-100 mt-6 max-w-2xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
            {/* First Card  */}
            <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
              <a
                href={items[index].main_image}
                target="__blank"
                rel="noreferrer"
              >
                <img
                  src={items[index].main_image}
                  alt="First card"
                  class="w-full h-full object-center object-cover"
                ></img>
              </a>
            </div>

            {/* Second Card  */}
            <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
              <a
                href={items[index].main_image}
                target="__blank"
                rel="noreferrer"
              >
                <img
                  src={items[index].main_image}
                  alt="First card"
                  class="w-full h-full object-center object-cover"
                ></img>
              </a>
            </div>

            {/* Third Card  */}
            <div class="hidden aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
              <a
                href={items[index].second_image}
                target="__blank"
                rel="noreferrer"
              >
                <img
                  src={items[index].second_image}
                  alt="First card"
                  class="w-full h-full object-center object-cover"
                  style={{ visibility: damage }}
                ></img>
              </a>
            </div>
          </div>

          <div class="bg-indigo-100 max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:pb-24 lg:px-8 lg:grid lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8">
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
              <p class="font-bold tracking-tight text-3xl text-gray-700 hover:text-green-900">
                £{items[index].price}
              </p>

              <div class="mt-6">
                <h3 class="sr-only">Reviews</h3>
                <div class="flex items-center">
                  <div class="flex items-center">
                    <svg
                      class="text-indigo-500 h-5 w-5 flex-shrink-0"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true"
                    >
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>

                    <svg
                      class="text-indigo-500 h-5 w-5 flex-shrink-0"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true"
                    >
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>

                    <svg
                      class="text-indigo-500 h-5 w-5 flex-shrink-0"
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
                    class="ml-3 text-base font-medium text-gray-600 hover:text-indigo-700"
                  >
                    4 Viewing
                  </a>
                </div>
              </div>
              <div class="mt-10">
                <div class="flex items-center justify-between">
                  <h3 class="text-sm text-gray-600 font-medium hover:text-indigo-700">
                    Enter Email
                  </h3>
                </div>
                <form onSubmit={(e) => inputEmail(e, input.email)}>
                  <input
                    type="email"
                    onChange={(e) =>
                      setInput({
                        ...input,
                        email: e.target.value,
                      })
                    }
                    className="form-control text-lg font-medium bg-gray-400 text-gray-900 hover:bg-indigo-400"
                    placeholder="Email"
                  />
                </form>
                <fieldset class="mt-4">
                  <div
                    style={{ visibility: alertMessage }}
                    class="bg-yellow-200 rounded-lg py-5 px-6 mb-4 text-xl text-red-700 mb-3"
                    role="alert"
                  >
                    Item is in some other customer's cart
                  </div>
                  <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                    <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-green-500 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                      <button
                        onClick={() =>
                          handleInput(
                            items[index].item,
                            items[index].category,
                            items[index].price,
                            items[index].tier
                          )
                        }
                      >
                        YES
                      </button>
                    </label>

                    <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-blue-300 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                      <button
                        onClick={() => removeItem(items[index].id, false)}
                      >
                        MAYBE
                      </button>
                    </label>

                    <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-red-500 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                      <button onClick={() => removeItem(items[index].id, true)}>
                        NO
                      </button>
                    </label>

                    <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:text-gray-50 hover:bg-indigo-500 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-1000 cursor-pointer">
                      <button onClick={() => showDamage(items[index].item)}>
                        Show Damage
                      </button>
                    </label>
                  </div>
                </fieldset>
              </div>

              <button
                class="mt-10 w-full bg-yellow-500 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                onClick={() => !disableCheckout && viewCart()}
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
                    class="inline-block px-6 py-2 border-2 border-gray-900 text-gray-900 hover:border-green-700 hover:bg-green-100 hover:text-green-500 font-medium text-xl leading-tight uppercase rounded focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-full"
                  >
                    Tier 1
                  </button>
                </div>
              </div>

              {/* Tier 2 Button */}
              <div class="mt-10">
                <div class="mt-4 space-y-6">
                  <button
                    onClick={() => viewTier("Tier 2")}
                    class="inline-block px-6 py-2 border-2 border-gray-900 text-gray-900 hover:border-orange-700 hover:bg-orange-100 hover:text-orange-500 font-medium text-xl leading-tight uppercase rounded focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-full"
                  >
                    Tier 2
                  </button>
                </div>
              </div>

              {/* Tier 3 Button */}
              <div class="mt-10">
                <div class="mt-4 space-y-6">
                  <button
                    onClick={() => viewTier("Tier 3")}
                    class="inline-block px-6 py-2 border-2 border-gray-900 text-gray-900 hover:border-yellow-700 hover:bg-yellow-100 hover:text-yellow-500 font-medium text-xl leading-tight uppercase rounded focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-full"
                  >
                    Tier 3
                  </button>
                </div>
              </div>

              {/* Tier 1 Span */}
              <div
                style={{ visibility: tier1Visibility }}
                class="bg-green-200 rounded-lg my-10 py-5 px-6 mb-4 text-lg text-red-700 mb-3"
                role="alert"
              >
                {tierItems} items are in Tier 1
              </div>

              {/* Tier 2 Span */}
              <div
                style={{ visibility: tier2Visibility }}
                class="bg-orange-200 rounded-lg my-10 py-5 px-6 mb-4 text-lg text-red-700 mb-3"
                role="alert"
              >
                {tierItems} items are in Tier 2
              </div>

              {/* Tier 3 Span */}

              <div
                style={{ visibility: tier3Visibility }}
                class="bg-blue-200 rounded-lg my-10 py-5 px-6 mb-4 text-lg text-red-700 mb-3"
                role="alert"
              >
                {tierItems} items are in Tier 3
              </div>
            </div>
          </div>
        </>
      ) : (
        <div className="py-12 bg-indigo-100">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="lg:text-center">
              <h2
                className="text-lg text-indigo-600 font-semibold cursor-pointer"
                onClick={() => navigate("/current-stock")}
              >
                Go Back
              </h2>
              <p className="mt-2 text-3xl leading-8 font-bold tracking-tight text-gray-900 sm:text-4xl sm:tracking-tight">
                No Products Found
              </p>
              <p className="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                There are currently no products available for purchase in this
                category. Please try again later.
              </p>
            </div>
          </div>
        </div>
      )}
    </main>
  );
}
