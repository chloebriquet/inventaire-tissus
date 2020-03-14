import axios from 'axios';

const baseUrl = document.origin;
const headers = {Accept: 'application/ld+json'};
const withCredentials = true;

export default axios.create({
    baseURL: baseUrl,
    headers: headers,
    withCredentials: withCredentials
});

export const API = axios.create({
    baseUrl: baseUrl + '/api',
    headers: headers,
    withCredentials: withCredentials
});
