Ext.define('sisscsj.model.security.User', {
    extend: 'Ext.data.Model',
    fields: [
        // non-relational properties
        {
            name: 'nombre_usuario',
            type: 'string',
            persist: false
        },
        {
            name: 'apellido_usuario',
            type: 'string',
            persist: false
        },
        {
            name: 'login_usuario',
            type: 'string',
            persist: false
        },
        {
            name: 'Roles',
            type: 'any',
            persist: false
        }
    ],
    inRole: function( RoleID ) {
        var me = this;
        return Ext.Array.contains( me.get( 'Roles' ), RoleID );
    } 
});