import logo from './logo.svg';
import './App.css';
import { Outlet, Link } from "react-router-dom";
import Header from "./components/header";

function App() {
  return (
    <div className="App">
      {/* <h1 className="App-header">
        goretro
      </h1> */}
      <Header />
      <nav
        style={{
          borderBottom: "solid 1px",
          paddingBottom: "1rem",
        }}
      >
        <Link to="/how-it-works">How It Works</Link> |{" "}
        <Link to="/current-stock">Current Stock</Link>
      </nav>
      <Outlet />
    </div>
  );
}

export default App;
