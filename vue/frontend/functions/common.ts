const requestData = async (url: string, method: string, data) => {
    const response = await fetch(url, {
        method: method,
        cache: "no-cache",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    });

    const r = await response.text();

    return r;
}

export default requestData;
