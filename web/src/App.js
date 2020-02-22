import React, { useState } from 'react';
import logo from './logo.svg';
import './App.css';

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
