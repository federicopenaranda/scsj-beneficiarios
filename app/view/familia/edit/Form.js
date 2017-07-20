Ext.define('sisscsj.view.familia.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.familia.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox',
        'Ext.ux.form.ItemSelector'
    ],
    initComponent: function() {
        
        var storePrivilegios = Ext.create('Ext.data.Store', {
            fields: ['nombre', 'valor'],
            data : [
                {"nombre":"familia.edit.tab.serviciobasico", "valor": (sisscsj.app.globals.globalTipoUsuario === 'proyecto') ? true : false },
                {"nombre":"familia.edit.tab.tipocasa", "valor": (sisscsj.app.globals.globalTipoUsuario === 'proyecto') ? true : false },
                {"nombre":"familia.edit.tab.metodoplanificacion", "valor": (sisscsj.app.globals.globalTipoUsuario === 'proyecto') ? true : false },
                {"nombre":"familia.edit.tab.eventovital", "valor": (sisscsj.app.globals.globalTipoUsuario === 'proyecto') ? true : false }
            ]
        });

        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: true,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'tabpanel',
                    bodyPadding: 5,
                    // set to false to disable lazy render of non-active tabs...IMPORTANT!!!
                    deferredRender: false,
                    items: [
                        {
                            xtype: 'familia.edit.tab.infofamilia',
                            title: 'Info. Familia'
                        },
                        {
                            xtype: 'familia.edit.tab.serviciobasico',
                            title: 'Servicios Básicos',
                            hidden: storePrivilegios.findRecord('nombre','familia.edit.tab.serviciobasico').getData().valor
                        },
                        {
                            xtype: 'familia.edit.tab.tipocasa',
                            title: 'Tipo de Casa',
                            hidden: storePrivilegios.findRecord('nombre','familia.edit.tab.tipocasa').getData().valor
                        },
                        {
                            xtype: 'familia.edit.tab.metodoplanificacion',
                            title: 'Método Planif. Familiar',
                            hidden: storePrivilegios.findRecord('nombre','familia.edit.tab.metodoplanificacion').getData().valor
                        },
                        {
                            xtype: 'familia.edit.tab.eventovital',
                            title: 'Eventos Vitales',
                            hidden: storePrivilegios.findRecord('nombre','familia.edit.tab.eventovital').getData().valor
                        },
                        {
                            xtype: 'familia.edit.tab.direccion',
                            title: 'Dirección'
                        },
                        {
                            xtype: 'familia.edit.tab.miembros',
                            title: 'Miembros'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});