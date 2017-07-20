Ext.define('sisscsj.view.beneficiario.edit.tab.Organizacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.organizacion',
    layout: 'form',
    width: 1000,
    height: 400,
    bodyPadding: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                labelAlign: 'top',
                allowBlank: true,
                flex: 1
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Información Organizacional de Beneficiario</strong>',
                    defaults: {
                        allowBlank: true,
                        layout: 'hbox'/*,
                        margins: '0 10 0 10'*/
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_nivel',
                                    fieldLabel: 'Nivel:',
                                    displayField: 'nombre_nivel',
                                    valueField: 'id_nivel',
                                    editable: false,
                                    itemId: 'fk_id_nivel',
                                    store: {
                                        type: 'opciones.nivel'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    forceSelection: true,
                                    allowBlank: true
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_curso',
                                    fieldLabel: 'Curso:',
                                    displayField: 'nombre_curso',
                                    valueField: 'id_curso',
                                    editable: false,
                                    itemId: 'fk_id_curso',
                                    disabled: true,
                                    store: {
                                        type: 'opciones.curso'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    forceSelection: true,
                                    allowBlank: true
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_turno',
                                    fieldLabel: 'Turno:',
                                    displayField: 'nombre_turno',
                                    valueField: 'id_turno',
                                    editable: false,
                                    store: {
                                        type: 'opciones.turno'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    forceSelection: true,
                                    allowBlank: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textfield',
                                    itemId: 'codigo_beneficiario',
                                    id: 'codigo_beneficiario',
                                    name: 'codigo_beneficiario',
                                    fieldLabel: 'Código:',
                                    readOnly: true
                                },
                                {
                                    xtype: 'numberfield',
                                    name: 'numero_hijo_beneficiario',
                                    fieldLabel: 'Número de Hijo:',
                                    editable: true,
                                    maxValue: 15,
                                    minValue: 1,
                                    allowBlank: true
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_formacion',
                                    fieldLabel: 'Formación:',
                                    displayField: 'nombre_formacion',
                                    valueField: 'id_formacion',
                                    editable: false,
                                    store: {
                                        type: 'opciones.formacion'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: false
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    name: 'trabaja_beneficiario',
                                    xtype: 'combo',
                                    fieldLabel: 'Trabaja?:',
                                    store: LocalStoreTrabaja,
                                    triggerAction: 'all',
                                    valueField: 'valor',
                                    displayField: 'nombre',
                                    queryMode: 'local',
                                    forceSelection: true,
                                    editable: false,
                                    allowBlank: false
                                },
                                {
                                    name: 'libreta_escolar_beneficiario',
                                    xtype: 'combo',
                                    fieldLabel: 'Libreta Escolar?:',
                                    store: LocalStoreLibreta,
                                    triggerAction: 'all',
                                    valueField: 'valor',
                                    displayField: 'nombre',
                                    queryMode: 'local',
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: false
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    name: 'carnet_de_salud_beneficiario',
                                    xtype: 'combo',
                                    fieldLabel: 'Carnet de Salud?:',
                                    editable: false,
                                    store: LocalStoreCarnetSalud,
                                    triggerAction: 'all',
                                    valueField: 'valor',
                                    displayField: 'nombre',
                                    queryMode: 'local',
                                    forceSelection: true,
                                    allowBlank: false
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_entidad_salud',
                                    fieldLabel: 'Entidad de Salud:',
                                    tpl: '<tpl for="."><div class="x-boundlist-item" >{nombre_entidad_salud}</div></tpl>',
                                    displayField: 'nombre_entidad_salud',
                                    valueField: 'id_entidad_salud',
                                    store: {
                                        type: 'opciones.entidadsalud'
                                    },
                                    editable: true,
                                    forceSelection: true,
                                    allowBlank: false,
                                    typeAhead: true,
                                    triggerAction: 'all',
                                    minChars : 1,
                                    totalProperty : 'total',
                                    pageSize : 10,
                                    listeners: {
                                        beforequery: function( queryPlan, eOpts ) {
                                            var nQuery = [];
                                            var tmpQuery = {
                                                nombre_entidad_salud: queryPlan.query
                                            };
                                            nQuery.push(tmpQuery); // push this to the array
                                            queryPlan.query = Ext.encode(nQuery);
                                        }
                                    }
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'checkboxfield',
                                    style: {
                                        marginLeft: '30px',
                                        marginTop: '20px'
                                    },
                                    boxLabel: '<strong>¿Registrar Beneficiario en Gestión Actual? <br> (Si se activa esta casilla la persona se inscribirá automáticamente en la gestión actual.</strong>)',
                                    name: 'registro_gestion_actual',
                                    itemId: 'registro_gestion_actual',
                                    uncheckedValue : 0,
                                    inputValue: 1,
                                    width: 300
                                }
                           ]
                        }
                    ]
               }
            ]
        });
        me.callParent(arguments);
    }
});
