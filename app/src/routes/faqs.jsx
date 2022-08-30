import Statusbar from "../components/Statusbar";

export default function Faqs() {
  return (
    <>
    <Statusbar />
    <main style={{ padding: "1rem 0" }}>
      <div>
        <section class="text-gray-700">
          <div class="container px-5 py-24 mx-auto">
            <div class="text-center mb-20">
              <h1 class="sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">
                Frequently Asked Question
              </h1>
              <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto">
                Questions commonly asked by our most clients
              </p>
            </div>
            <div class="flex flex-wrap lg:w-4/5 sm:mx-auto sm:mb-2 -mx-2">
              <div class="w-full lg:w-1/2 px-4 py-2">
                <details class="mb-4">
                  <summary class="font-semibold  bg-gray-200 rounded-md py-2 px-4">
                    How GoRetro works ?
                  </summary>

                  <span>
                    GoRetro basically offers a platform for wholesale dealers
                    and individual customers to purchase vintage stuff.
                  </span>
                </details>
                <details class="mb-4">
                  <summary class="font-semibold bg-gray-200 rounded-md py-2 px-4">
                    How can i place an order?
                  </summary>

                  <span>
                    To place your order go to current stock and from there
                    choose category you want to buy then add to cart and proceed
                    to checkout.
                  </span>
                </details>
                <details class="mb-4">
                  <summary class="font-semibold  bg-gray-200 rounded-md py-2 px-4">
                    What are available payment methods?
                  </summary>

                  <span>
                    Available payment methods are all major bank cards{" "}
                    <strong>VISA</strong>
                    and<strong>MasterCard</strong>. Other payment platforms
                    include
                    <strong>
                      Apple Pay, Google Pay, PayPal, Klerna Pay and Amazon Pay
                    </strong>
                    Direct bank transfer also supported with additional fees.
                  </span>
                </details>
              </div>
              <div class="w-full lg:w-1/2 px-4 py-2">
                <details class="mb-4">
                  <summary class="font-semibold  bg-gray-200 rounded-md py-2 px-4">
                    Days for delivery and charges of delivery?
                  </summary>

                  <span class="px-4 py-2">
                    The order will be shipped to your shipping address in 3
                    business days.
                    <strong>£50</strong> will be delivery fee. And{" "}
                    <strong>20%</strong> Tax is applicable on orders in UK.
                    Orders above <strong>£500</strong> are free delivery.
                  </span>
                </details>
                <details class="mb-4">
                  <summary class="font-semibold  bg-gray-200 rounded-md py-2 px-4">
                    I have more questions ?
                  </summary>

                  <span class="px-4 py-2">
                    Please feel free to write us at{" "}
                    <strong>support@goretro.com</strong>
                  </span>
                </details>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
    </>
  );
}
