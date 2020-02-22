import React from 'react'

// set UserContext and add type
const UserContext = React.createContext({});

export const UserProvider = UserContext.Provider
export const UserConsumer = UserContext.Consumer
export default UserContext
