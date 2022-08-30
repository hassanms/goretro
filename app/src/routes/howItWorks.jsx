
import Statusbar from "../components/Statusbar"
export default function HowItWorks() {
    return (
        <>
        <Statusbar />
        <main class="flex items-center flex-col justify-center p-10">
            <div class="flex items-center justify-center">
                <iframe 
                    width="700" 
                    height="375" 
                    src="https://www.youtube.com/embed/MSevAi_YarQ" 
                    title="YouTube video player" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen
                >
                </iframe>
            </div>
            <div class="p-10 w-5/6 leading-loose">
                EDTEX FZC (Free Zone Company) is based in Sharjah, UAE in the special economic Free Zone. With in depth knowledge of the vintage/used branded wholesale and retail markets worldwide we offer specialized solutions to meet clients needs.
            </div>
            <div class="px-10 w-5/6 leading-loose">
                <h2>Our Core Offerings are:</h2>
                Wholesale - Due to our strategic location, favourable tax benefits and great shipping routes by air and sear, we are able to sort our own rag and deliver a fine grade of used branded clothing to clients at scale with consistency.
            </div>
        </main>
        </>
    );
}