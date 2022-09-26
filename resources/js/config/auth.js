import axios from "axios";
class Auth {
    constructor() {
        this.token = window.localStorage.getItem('token');
        let expires_at = window.localStorage.getItem('expires_at');
        let myDate = new Date();
        var displayDate = myDate.getMonth()+ '/' +myDate.getDate()+ '/' +myDate.getFullYear()+ ' ' +this.formatAMPM(myDate);
        this.expires_at = expires_at ? JSON.stringify(expires_at) : null;
        if (this.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;
        }
        if(this.expires_at == displayDate){
            window.localStorage.removeItem('expires_at');
            window.localStorage.removeItem('token');
        }
    }
    formatAMPM(date) { // This is to display 12 hour format like you asked
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? '' : '';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return strTime;
    }
    login(token, expires_at) {
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('expires_at', expires_at);
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        this.token = token;
        // this.user = user;
    }
    check() {
        return !!this.token;
    }
    logout() {
        // window.localStorage.clear();
        window.localStorage.removeItem('expires_at');
        window.localStorage.removeItem('token');

    }
}
export default new Auth();