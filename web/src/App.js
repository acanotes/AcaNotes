import React, { useState, useEffect } from 'react';
import logo from './logo.svg';
import 'styles/index.less';
import {message} from 'antd';

import { BrowserRouter as Router, Route, Switch, Redirect } from "react-router-dom";

import MainPage from './pages/MainPage';
import RegisterPage from './pages/Auth/RegisterPage';
import LoginPage from './pages/Auth/LoginPage';

import CreatePage from './pages/Create';
import TodayPage from './pages/Today';

import { getCookie, setCookie, tokenGetClaims } from './utils'
import { verifyToken } from './actions/auth'
import { UserProvider } from './UserContext';

function App() {
  const [user, setUser] = useState({token:"", loggedIn: true});

  const token = getCookie('acanotes_alpaca_token');

  useEffect(() => {

    // if this token exists, check it and verify it
    if (token != "") {
      verifyToken(token).then(() => {
        let user = tokenGetClaims(token);
        setUser({token: token, loggedIn:true, ...user});
        message.success("Welcome back " + user.firstName);
      }).catch((err) => {
        message.error("An error occured with trying to log you back in automatically");
      });
    }
    // otherwise, do nothing
  },[]);
  const requireAuth = (Component) => {
    if (user.loggedIn) {

      return <Component />;
    }
    else {
      message.info("You need to login to access that page")
      return <Redirect href="/" />;
    }
  }
  return (
    <Router>
      <div>
        <Switch>
          <UserProvider value={{user: user, setUser: setUser, logout: () => {setUser({token:"", loggedIn: false}); setCookie("acanotes_alpaca_token", ""); message.info("Logged out")}}}>
            <Route path="/" exact component={() => {return (<MainPage />)}} />
            <Route path="/login" exact component={LoginPage} />
            <Route path="/register" exact component={RegisterPage} />
            <Route path="/create" exact component={() => { return requireAuth(CreatePage) }} />
            <Route path="/today" exact component={() => requireAuth(TodayPage)} />
          </UserProvider>
        </Switch>
      </div>
    </Router>
  );
}

export default App;
