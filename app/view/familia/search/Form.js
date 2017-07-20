Ext.define('sisscsj.view.familia.search.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.familia.search.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.FieldSet',
        'Ext.form.field.Date',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'Ext.slider.Multi',
        'sisscsj.ux.form.field.RemoteComboBox',
        'sisscsj.ux.form.field.plugin.ClearTrigger'
    ],
    initComponent: function () {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: 'Detalles del Beneficiario',
                    collapsible: true,
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'textfield',
                                    name: 'primer_nombre_beneficiario',
                                    fieldLabel: 'Primer Nombre:'
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'segundo_nombre_beneficiario',
                                    fieldLabel: 'Segundo Nombre:'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'textfield',
                                    name: 'apellido_paterno_beneficiario',
                                    fieldLabel: 'Apellido Paterno:'
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'apellido_materno_beneficiario',
                                    fieldLabel: 'Apellido Materno:'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'textfield',
                                    name: 'codigo_familia',
                                    fieldLabel: 'Código Nuevo:'
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'codigo_familia_antiguo',
                                    fieldLabel: 'Código Antiguo:'
                                }
                            ]
                        }/*,
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'id_donante',
                                    fieldLabel: 'Donante:',
                                    displayField: 'nombre_donante',
                                    valueField: 'id_donante',
                                    store: {
                                        type: 'opciones.donante'
                                    },
                                    plugins: [
                                        {ptype: 'cleartrigger'}
                                    ],
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: true
                                }
                            ]
                        }*/
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});