import React from "react";
import { BrowserRouter } from "react-router-dom";
import './App.css';
import Routes from "./Routes";

function App() {
  return (
    <BrowserRouter>
      <Routes></Routes>
    </BrowserRouter>
  );
}

export default App;
