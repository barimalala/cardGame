const getUrl = window.location;
const baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

export const API_ENDPOINT = baseUrl +'card';
export const API_ENDPOINT_COLOR = API_ENDPOINT + '/color';
export const API_ENDPOINT_VALUE = API_ENDPOINT + '/grade';
export const API_ENDPOINT_ORDER = API_ENDPOINT + '/order';