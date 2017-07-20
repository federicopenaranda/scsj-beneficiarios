Ext.define('sisscsj.view.beneficiario.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.beneficiario.edit.form',
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
                            xtype: 'beneficiario.edit.tab.personal',
                            title: 'Info. Personal'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.organizacion',
                            title: 'Info. de Organización'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.otros',
                            title: 'Otra Info.'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.estadobeneficiario',
                            title: 'Estado'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.entidad',
                            title: 'Entidad'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.telefonos',
                            title: 'Teléfonos'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.estadocivil',
                            title: 'Estado Civil'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.tipoidentificacion',
                            title: 'Identificación'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.ocupacion',
                            title: 'Ocupaciones'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.trabajo',
                            title: 'Trabajos'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.idioma',
                            title: 'Idiomas'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.unidadeducativa',
                            title: 'Unidad Educativa'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.otrosprogramas',
                            title: 'Otros Programas'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.actividadfavorita',
                            title: 'Actividades Favoritas'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.donante',
                            title: 'Donante'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.patrocinador',
                            title: 'Patrocinador'
                        },
                        {
                            xtype: 'beneficiario.edit.tab.historiasocial',
                            title: 'Historia Social'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});