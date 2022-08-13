import logo from './logo.svg';
import './App.css';
import { Outlet } from "react-router-dom";
import Header from "./components/header";
import HowItWorks from "./routes/howItWorks";
import { useLocation } from "react-router-dom"

function App() {
  return (
    <div className="App" class="bg-orange-50">
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
