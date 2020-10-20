export default class User {
    '@context'?: string;
    '@id'?: string;
    '@type'?: string;
    uuid: string;
    username: string;
    email: string;
    roles: string[];

    constructor(
        uuid: string = '',
        username: string = '',
        email: string = '',
        roles: string[] = []
    ) {
        this.uuid = uuid;
        this.username = username;
        this.email = email;
        this.roles = roles;
    }
}
