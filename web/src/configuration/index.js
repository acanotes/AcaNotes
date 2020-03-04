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
    },
    announcements: {
      latest: "/api/v1/announcements/latest.php"
    },
    users: {
      getTop: "/api/v1/users/getTop.php",
      getUser: "/api/v1/users/getUser.php"
    },
    notes: {
      getTopNotes: "/api/v1/notes/getTopNotes.php",
      latest:"/api/v1/notes/latest.php",
      getNote: "/api/v1/notes/getNote.php"
    }
  }
}
