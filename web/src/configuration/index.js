let root = '';
if (!process.env.NODE_ENV || process.env.NODE_ENV === 'development') {
  root = 'http://localhost:5000';
}

export default {
  API_URL: root,
  routes: {
    auth: {
      login: "/api/v1/auth/login.php",
      register: "/api/v1/auth/register.php",
      verify:"/api/v1/auth/verify.php"
    },
    create: {
      note: "/api/v1/content/createNote.php"
    }
  }
}
