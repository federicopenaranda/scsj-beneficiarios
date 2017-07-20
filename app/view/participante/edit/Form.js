Ext.define('sisscsj.view.participante.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.participante.edit.form',
    //waitMsgTarget: true,
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox'
    ],
    initComponent: function() {
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
                            xtype: 'participante.edit.tab.personal',
                            title: 'Info. Personal'
                        },
                        {
                            xtype: 'participante.edit.tab.organizacion',
                            title: 'Info. de Organización'
                        },
                        {
                            xtype: 'participante.edit.tab.otros',
                            title: 'Otra Info.'
                        },
                        {
                            xtype: 'participante.edit.tab.estadoparticipante',
                            title: 'Estado'
                        },
                        {
                            xtype: 'participante.edit.tab.entidad',
                            title: 'Entidad'
                        },
                        {
                            xtype: 'participante.edit.tab.telefonos',
                            title: 'Teléfonos'
                        },
                        {
                            xtype: 'participante.edit.tab.estadocivil',
                            title: 'Estado Civil'
                        },
                        {
                            xtype: 'participante.edit.tab.tipoidentificacion',
                            title: 'Identificación'
                        },
                        {
                            xtype: 'participante.edit.tab.ocupacion',
                            title: 'Ocupaciones'
                        },
                        {
                            xtype: 'participante.edit.tab.trabajo',
                            title: 'Trabajos'
                        },
                        {
                            xtype: 'participante.edit.tab.idioma',
                            title: 'Idiomas'
                        },
                        {
                            xtype: 'participante.edit.tab.unidadeducativa',
                            title: 'Unidad Educativa'
                        },
                        {
                            xtype: 'participante.edit.tab.otrosprogramas',
                            title: 'Otros Programas'
                        },
                        {
                            xtype: 'participante.edit.tab.actividadfavorita',
                            title: 'Actividades Favoritas'
                        },
                        {
                            xtype: 'participante.edit.tab.donante',
                            title: 'Donante'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});