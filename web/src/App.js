import React, { useState, useEffect } from 'react';
import logo from './logo.svg';
import 'styles/index.less';
import {message} from 'antd';

import { BrowserRouter as Router, Route, Switch, Redirect } from "react-router-dom";

import MainPage from './pages/MainPage';
import RegisterPage from './pages/Auth/RegisterPage';
import LoginPage from './pages/Auth/LoginPage';
import ContributorsPage from './pages/Contributors';
import NotesWikiPage from './pages/NotesWiki';

import NotePage from './pages/NotePage';

import CreatePage from './pages/Create';
import TodayPage from './pages/Today';

import ProfilePage from './pages/ProfilePage';
import EditProfilePage from './pages/EditProfilePage';

import { getCookie, setCookie, tokenGetClaims } from './utils'
import { verifyToken } from './actions/auth'
import { UserProvider } from './UserContext';
let tokenChecked = false;

function App() {
  const [user, setUser] = useState({token:"", loggedIn: false});
  const [sessionReady, setSessionReady] = useState(false);
  const token = getCookie('acanotes_alpaca_token');

  useEffect(() => {

    // if this token exists, check it and verify it
    if (token != "") {
      verifyToken(token).then(() => {
        let user = tokenGetClaims(token);
        setUser({token: token, loggedIn:true, ...user});
        setSessionReady(true);
        message.success("Welcome back " + user.firstName);
      }).catch((err) => {
        // message.error("An error occured with trying to log you back in automatically");
        setSessionReady(true);
      });
    }
    else {
      setSessionReady(true);
    }
    // otherwise, do nothing
  },[]);
  const requireAuth = (Component, props) => {
    if (user.loggedIn) {

      return <Component {...props} />;
    }
    else {
      message.info("You need to login to access that page")
      return <Redirect href="/" />;
    }
  }
  return (
    <Router>
      <div>
        {sessionReady &&
          <Switch>
            <UserProvider value={{user: user, setUser: setUser, logout: () => {setUser({token:"", loggedIn: false}); setCookie("acanotes_alpaca_token", ""); message.info("Logged out")}}}>
              <Route path="/" exact component={() => {return (<MainPage />)}} />
              <Route path="/login" exact component={LoginPage} />
              <Route path="/register" exact component={RegisterPage} />
              <Route path="/contributors" exact component={ContributorsPage} />
              <Route path="/users/:id" exact component={(props) => requireAuth(ProfilePage, props)} />
              <Route path="/editProfile" exact component={() => requireAuth(EditProfilePage)} />
              <Route path="/create" exact component={() => requireAuth(CreatePage)} />
              <Route path="/today" exact component={() => requireAuth(TodayPage)} />
              <Route path="/notes-wiki" exact component={() => requireAuth(NotesWikiPage)} />
              <Route path="/notes-wiki/note/:id" exact component={(props) => requireAuth(NotePage, props)} />
            </UserProvider>
          </Switch>
        }
      </div>
    </Router>
  );
}

export default App;
