package com.guideapp.guideapp.ui.adapters;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.guideapp.guideapp.R;
import com.guideapp.guideapp.model.MainMenuTemp;

import java.util.List;


public class SearchAdapter
        extends RecyclerView.Adapter<SearchAdapter.ViewHolder>
        implements View.OnClickListener {
    private List<MainMenuTemp> items;
    private OnItemClickListener onItemClickListener;
    private Context mContext;

    public SearchAdapter(Context context, List<MainMenuTemp> items) {
        this.items = items;
        this.mContext = context;
    }

    public void setOnItemClickListener(OnItemClickListener onItemClickListener) {
        this.onItemClickListener = onItemClickListener;
    }

    @Override public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(parent.getContext()).inflate(
                R.layout.item_search, parent, false);
        v.setOnClickListener(this);
        return new ViewHolder(v);
    }

    @Override public void onBindViewHolder(ViewHolder holder, int position) {
        MainMenuTemp item = items.get(position);

        holder.text.setText(item.getText());

        holder.itemView.setTag(item);
    }

    @Override public int getItemCount() {
        return items.size();
    }

    @Override public void onClick(final View v) {
        onItemClickListener.onItemClick(v, (MainMenuTemp) v.getTag());
    }

    protected static class ViewHolder extends RecyclerView.ViewHolder {
        public TextView text;

        public ViewHolder(View itemView) {
            super(itemView);
            text = (TextView) itemView.findViewById(R.id.text_view);
        }
    }

    public interface OnItemClickListener {
        void onItemClick(View view, MainMenuTemp mainMenu);
    }
}
