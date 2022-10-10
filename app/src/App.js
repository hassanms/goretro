import { Outlet } from "react-router-dom";
import Header from "./components/header";
import HowItWorks from "./routes/howItWorks";
import { useLocation } from "react-router-dom"

function App() {
    return (
        <div style={{ minHeight: "100%" }} className="App" class="bg-orange-50 h-screen">
            <Header />
            {
                useLocation().pathname === "/" &&
                <HowItWorks />
            }
            <Outlet />
        </div>
    );
}

export default App;
