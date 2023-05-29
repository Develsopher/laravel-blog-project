import './bootstrap';
import '../css/app.css';
import Search from './live-search';

if (document.querySelector(".header-search-icon")) {
    new Search();
}
