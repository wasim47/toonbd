package app.softxmagic.medical.bdicu.home;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.bumptech.glide.Glide;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Hashtable;
import java.util.List;
import java.util.Map;

import app.softxmagic.medical.bdicu.HospitalModel;
import app.softxmagic.medical.bdicu.R;
import app.softxmagic.medical.bdicu.common.Config;
import app.softxmagic.medical.bdicu.common.ConnectivityReceiver;
import app.softxmagic.medical.bdicu.common.DisconnectAdapter;

public class HospitalProccessActivity extends Fragment
        implements ConnectivityReceiver.ConnectivityReceiverListener{

    RecyclerView recyclerView;
    RecyclerView.LayoutManager layoutManager;
    Config conf=new Config();
    ProgressDialog progressDialog;
    Dialog fdialog;
    Button filter;
    private final String URL = conf.getURL()+"get_hospital.php";
    private final String URLD = conf.getURL()+"get_division.php";
    private final String URLDIS = conf.getURL()+"get_district.php";
    private final String URLICU = conf.getURL()+"get_icubedtype.php";
    //String display = "all";
    String getAvl;

    @Override
     public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
            View view = inflater.inflate(R.layout.activity_hospital_proccess, container, false);
            recyclerView = (RecyclerView) view.findViewById(R.id.recylv);
            filter = (Button) view.findViewById(R.id.filter);
            filter.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    showFilterDialog();
                }
            });
            fdialog = new Dialog(getActivity());
            checkConnection("","","","","");
            return view;
        }

    public void showFilterDialog() {
        fdialog.setCancelable(true);
        fdialog.setContentView(R.layout.filter_dialog);
        fdialog.show();
        String selectedAvailability;
        ///////////////////// Division//////////////////////////////
       final List<String> list=new ArrayList<>();
        final AutoCompleteTextView division = (AutoCompleteTextView) fdialog.findViewById(R.id.division);
        StringRequest request = new StringRequest(URLD, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.d("divisiondisplay",response);
                try {
                    JSONObject object=new JSONObject(response);
                    JSONArray array=object.getJSONArray("details");
                    for(int i=0;i<array.length();i++) {
                        JSONObject object1=array.getJSONObject(i);
                        String name =object1.getString("name");
                        list.add(name);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
            }
        });
        RequestQueue queue = Volley.newRequestQueue(getActivity());
        queue.add(request);

        final ArrayAdapter<String> dataAdapter = new ArrayAdapter<String>
                (getActivity(), R.layout.autocomplete_list, list);
        division.setThreshold(0);
        division.setAdapter(dataAdapter);

        ///////////////////// District//////////////////////////////
        final List<String> districtList =new ArrayList<>();
        final AutoCompleteTextView district = (AutoCompleteTextView) fdialog.findViewById(R.id.district);
        StringRequest requestD = new StringRequest(URLDIS, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.d("districtdisplay",response);
                try {
                    JSONObject object=new JSONObject(response);
                    JSONArray array=object.getJSONArray("details");
                    for(int i=0;i<array.length();i++) {
                        JSONObject object1=array.getJSONObject(i);
                        String name =object1.getString("name");
                        districtList.add(name);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
            }
        });
        RequestQueue queueD = Volley.newRequestQueue(getActivity());
        queueD.add(requestD);

        final ArrayAdapter<String> districtAdapter = new ArrayAdapter<String>
                (getActivity(), R.layout.autocomplete_list, districtList);
        district.setThreshold(0);
        district.setAdapter(districtAdapter);

///////////////////// Division//////////////////////////////
        final List<String> bedlist=new ArrayList<>();
        final AutoCompleteTextView bedtype = (AutoCompleteTextView) fdialog.findViewById(R.id.bedtype);
        StringRequest requestB = new StringRequest(URLICU, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.d("divisiondisplay",response);
                try {
                    JSONObject object=new JSONObject(response);
                    JSONArray array=object.getJSONArray("details");
                    for(int i=0;i<array.length();i++) {
                        JSONObject object1=array.getJSONObject(i);
                        String name =object1.getString("name");
                        bedlist.add(name);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
            }
        });
        RequestQueue queueB = Volley.newRequestQueue(getActivity());
        queueB.add(requestB);

        final ArrayAdapter<String> bedtypeAdapter = new ArrayAdapter<String>
                (getActivity(), R.layout.autocomplete_list, bedlist);
        bedtype.setThreshold(0);
        bedtype.setAdapter(bedtypeAdapter);

     ////////////////////////////// availvality//////////////////////////
        Spinner available = (Spinner) fdialog.findViewById(R.id.availability);
        ArrayAdapter<CharSequence> adapter_available = ArrayAdapter.createFromResource(getActivity(),
                R.array.availability_array, android.R.layout.simple_spinner_item);
        adapter_available.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        available.setAdapter(adapter_available);
        available.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int i, long l) {
                getAvl = parent.getItemAtPosition(i).toString();
                //Toast.makeText(getActivity(), selecteditem, Toast.LENGTH_LONG).show();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });

        Button closebt = (Button) fdialog.findViewById(R.id.canceltn);
        closebt.setOnClickListener(new android.view.View.OnClickListener() {
            @Override
            public void onClick(android.view.View view) {
                fdialog.dismiss();
            }
        });


        final EditText area = (EditText) fdialog.findViewById(R.id.area);
        Button searchbtn = (Button) fdialog.findViewById(R.id.search);
        searchbtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String getDiv = division.getText().toString();
                String getDis = district.getText().toString();
                String getIcu = bedtype.getText().toString();
                String getArea = area.getText().toString();
                checkConnection(getDiv,getDis,getArea,getIcu,getAvl);
                fdialog.dismiss();
            }
        });

    }

    public void sliderfunc(final String getDiv,final String getDis,final String getArea,final String getIcu,final String getAvl){
        progressDialog = new ProgressDialog(getActivity());
        progressDialog.setTitle("Hospital List");
        progressDialog.setMessage("Loading Please Wait...");
        progressDialog.setCancelable(false);
        progressDialog.setButton(DialogInterface.BUTTON_NEGATIVE, "Cancel", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.dismiss();
                onBackPressed();
            }
        });
        progressDialog.show();

        layoutManager = new LinearLayoutManager(getActivity());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setHasFixedSize(true);

        StringRequest request = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                progressDialog.dismiss();
                Log.d("Code",response);
                GsonBuilder gsonBuilder = new GsonBuilder();
                Gson gson = gsonBuilder.create();
                HospitalModel[] news = gson.fromJson(response, HospitalModel[].class);
                recyclerView.setAdapter(new HospitalRecyclerAdapter(getActivity(), news));

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();

            }
        }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params = new Hashtable<String, String>();
                params.put("division", getDiv);
                params.put("district", getDis);
                params.put("area", getArea);
                params.put("bedtype", getIcu);
                params.put("availability", getAvl);

                return params;
            }
        };

        RequestQueue queue = Volley.newRequestQueue(getActivity());
        queue.add(request);
    }

    private void checkConnection(String getDiv,String getDis,String getArea,String getIcu,String getAvl) {
        boolean isConnected = ConnectivityReceiver.isConnected();
        String message;
        if (isConnected) {
            String allvals = getDiv+"-"+getDis+"-"+getArea+"-"+getIcu+"-"+getAvl;
            Log.d("filterVlues",allvals);
            sliderfunc(getDiv,getDis,getArea,getIcu,getAvl);
        } else {
            message = "No Connection";
            Toast.makeText(getActivity(), message, Toast.LENGTH_LONG).show();
            recyclerView.setLayoutManager(new LinearLayoutManager(getActivity()));
            recyclerView.setAdapter(new DisconnectAdapter(getActivity()));
        }
    }
    @Override
    public void onNetworkConnectionChanged(boolean isConnected) {
        //showSnack(isConnected);
        String message;
        if (isConnected) {
            Toast.makeText(getActivity(), "Connected", Toast.LENGTH_LONG).show();
        } else {
            message = "No Connection";
            Toast.makeText(getActivity(), message, Toast.LENGTH_LONG).show();
            recyclerView.setLayoutManager(new LinearLayoutManager(getActivity()));
            recyclerView.setAdapter(new DisconnectAdapter(getActivity()));
        }
    }
        public void onBackPressed() {
            getActivity().onBackPressed();
        }
        private void showToastMessage(String msg) {
            Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
        }
    }