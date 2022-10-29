import axios from 'axios'

axios.interceptors.request.use((request) => {
    const token = $cookies.get("token")
    request.headers.Authorization = `Bearer ${token}`
    return request;
}, function(error) {
  return Promise.reject(error);
});