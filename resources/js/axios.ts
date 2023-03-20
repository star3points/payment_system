import axios, {AxiosError, AxiosInstance, InternalAxiosRequestConfig} from 'axios'

class Client {
    public client: AxiosInstance;
    private retries: number = 0;

    constructor(
        // protected authApiUrl: String = import.meta.env.VITE_AUTH_API_URL,
        protected apiUrl: String = import.meta.env.VITE_API_URL
    ) {
        this.client = axios.create({
            baseURL: String(this.apiUrl),
        });
        this.client.interceptors.request.use(
            (config) => {
                return this.setToken(config);
            },
            (err) => {
                this.refreshToken(err)
            }
        );
        this.client.interceptors.response.use(
            (config) => {
                console.log(config)
                return config;
            },
            (err) => {
                this.refreshToken(err)
            }
        );
    }

    public getAxios(): AxiosInstance {
        return this.client;
    }

    private setToken(config: InternalAxiosRequestConfig): InternalAxiosRequestConfig {
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`;
        return config;
    }

    private async refreshToken(err: AxiosError) {
        console.log(err);
        this.retries++;
        if (err.response.status === 401 && this.retries < 2) {
            let res = await this.client.post('auth/refresh')
            console.log(res);
            if (res.data.access_token) {
                console.log(res.data);
                localStorage.setItem('access_token', res.data.access_token)
            }
        } else {
            console.log('redirect')
        }
    }
}

export default new Client(
    import.meta.env.VITE_API_URL
).getAxios();
