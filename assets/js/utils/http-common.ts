import axios, { AxiosRequestConfig } from 'axios';

const baseUrl: string = window.location.origin;
const apiUrl: string = baseUrl + '/api';
const headers: object = { Accept: 'application/ld+json' };
const withCredentials: boolean = true;

const defaultConfig: AxiosRequestConfig = {
  baseURL: baseUrl,
  headers: headers,
  withCredentials: withCredentials,
};

const apiConfig: AxiosRequestConfig = {
  baseURL: apiUrl,
  headers: headers,
  withCredentials: withCredentials,
};

export default axios.create(defaultConfig);
export const API = axios.create(apiConfig);
