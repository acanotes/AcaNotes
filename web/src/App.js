import React, { useState } from 'react';
import logo from './logo.svg';
import './styles/index.scss';

import { BrowserRouter as Router, Route, Switch, Redirect } from "react-router-dom";
import MainPage from './pages/MainPage';
import { UserProvider } from './UserContext';

function App() {
  const [user, setUser] = useState({username:"", email:"", points:""});
  return (
    <Router>
      <div>
        <Switch>
          <UserProvider value={{user: user, setUser: setUser}}>
            <Route path="/" exact component={MainPage} />
          </UserProvider>
        </Switch>
      </div>
    </Router>
  );
}

export default App;
