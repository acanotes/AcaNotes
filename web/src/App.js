import React, { useState } from 'react';
import logo from './logo.svg';
import 'styles/index.less';

import { BrowserRouter as Router, Route, Switch, Redirect } from "react-router-dom";
import MainPage from './pages/MainPage';
import LoginPage from './pages/LoginPage';

import { UserProvider } from './UserContext';

function App() {
  const [user, setUser] = useState({username:"", email:"", points:"", loggedIn: false});
  return (
    <Router>
      <div>
        <Switch>
          <UserProvider value={{user: user, setUser: setUser}}>
            <Route path="/" exact component={MainPage} />
            <Route path="/login" exact component={LoginPage} />
          </UserProvider>
        </Switch>
      </div>
    </Router>
  );
}

export default App;
