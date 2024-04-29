function isEmailValid(email: string): boolean {
    return email.includes('@');
}

function isUrlValid(url: string): boolean {
    return url.includes('http');
}
